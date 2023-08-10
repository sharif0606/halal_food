<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Order;
use App\Http\Traits\ResponseTrait;

class CartController extends Controller
{
    use ResponseTrait;
    public function cartPage()
    {
        $carts=Cart::content();
        $total_price=Cart::subtotal();
        // return $carts;
        // return view('product.checkout',compact('carts','total_price'));
        if($total_price>0){
            return view('product.cart',compact('carts','total_price'));
        }else{
            return view('product.empty_cart');
        }
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $id = $request->product_id;
        $order_qty = $request->order_qty;
        $product=DB::table('db_items')->where('id',$id)->first();
        Cart::add([
            'id'=>$product->id,
            'name'=>$product->item_name,
            'price'=>$product->sales_price,
            'weight'=>0,
            'product_stock'=>$product->stock,
            'qty'=>$order_qty,
            'options'=>[
                'product_image' => $product->item_image
            ]
        ]);

        $this->couponCheck();
        return back();

    }
    /*======= removeFromCart =======*/
    public function removeFromCart($cart_id)
    {
        Cart::remove($cart_id);
        $this->couponCheck();
        // Toastr::info('Product Removed from Cart!!');
        return back();
    }

    public function couponCheck()
    {
        //dd($request->all());
        if (Session::has('coupon')){
            $cuponcode=Session::get('coupon')['cupon_code'];
        }else{
            return false;
        }
        $check=Coupon::where('cupon_code',$cuponcode)->first();
        // print_r($check->discount);
        // print_r(Cart::subtotal());
        $cartsubtotal=str_replace(",", "", Cart::subtotal());


        //if valid coupon found
        if($check !=null){
            //check coupon validity
            $check_validity=$check->finish_date>Carbon::now()->format('Y-m-d');
            //if coupon date is not expried
            if($check_validity && $check->discount_type==0){
                Session::put('coupon',[
                    'cupon_code'=>$check->cupon_code,
                    'discount'=>($cartsubtotal * $check->discount)/100,
                    'cart_total'=> $cartsubtotal,
                    'balance'=> $cartsubtotal - ($cartsubtotal * $check->discount)/100
                ]);
                return true;
            }else if($check_validity && $check->discount_type==1){
                Session::put('coupon',[
                    'cupon_code'=>$check->cupon_code,
                    'discount'=>$check->discount,
                    'cart_total'=> $cartsubtotal,
                    'balance'=> $cartsubtotal - $check->discount
                ]);
                return true;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }


    public function couponApply(Request $request)
    {
        //dd($request->all());
        $oldcupon=Order::where('user_id',Session::get('userId'))->where('cupon_code',$request->cupon_code)->count();
        if($oldcupon > 0){
            return redirect()->back()->with($this->resMessageHtml(false, 'error','Coupon already applied !'));
        }
        $check=Coupon::where('cupon_code',$request->cupon_code)->first();
        // print_r($check->discount);
        // print_r(Cart::subtotal());
        $cartsubtotal=str_replace(",", "", Cart::subtotal());
        //if session got existing coupon, then don't allow double coupon
        if(Session::get('coupon')){
            // Toastr::error('Already Applied coupon!!','Info!!');
            return redirect()->back()->with($this->resMessageHtml(false, 'error','Coupon already applied!'));
        }

        //if valid coupon found
        if($check !=null){
            //check coupon validity
            $check_validity=$check->finish_date>Carbon::now()->format('Y-m-d');
            //if coupon date is not expried
            if($check_validity && $check->discount_type==0){
                Session::put('coupon',[
                    'cupon_code'=>$check->cupon_code,
                    'discount'=>($cartsubtotal * $check->discount)/100,
                    'cart_total'=> $cartsubtotal,
                    'balance'=> $cartsubtotal - ($cartsubtotal * $check->discount)/100
                ]);
                // Toastr::success('Coupon Percentage Applied!!','Successfully!!');
                return redirect()->back()->with($this->resMessageHtml(true, 'message','Coupon percentage applied successfully!'));
            }else if($check_validity && $check->discount_type==1){
                Session::put('coupon',[
                    'cupon_code'=>$check->cupon_code,
                    'discount'=>$check->discount,
                    'cart_total'=> $cartsubtotal,
                    'balance'=> $cartsubtotal - $check->discount
                ]);
                // Toastr::success('Coupon Percentage Applied!!','Successfully!!');
                return redirect()->back()->with($this->resMessageHtml(true, 'message','The coupon has been successfully applied for specified amount!'));
            }else{
                // Toastr::error('কুপন তারিখ মেয়াদ শেষ!!!','Info!!');
                return redirect()->back()->with($this->resMessageHtml(false, 'error','Coupon has expired!'));
            }
        }else{
            // Toastr::error('অবৈধ অ্যাকশন/কুপন! চেক, খালি কার্ট');
            return redirect()->back()->with($this->resMessageHtml(false, 'error','The coupon code you entered is incorrect'));
        }
    }

    public function removeCoupon($cupon_code)
    {
        Session::forget('coupon');
        // Toastr::success('কুপন সরানো হয়েছে সফলভাবে!!');
        return redirect()->back()->with($this->resMessageHtml(false, 'error','Coupon has been successfully removed'));
    }

}
