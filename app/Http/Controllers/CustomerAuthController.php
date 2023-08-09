<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerSigninRequest;
use App\Http\Requests\CustomerSignupRequest;
use App\Models\CustomerAuth;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Session;

class CustomerAuthController extends Controller
{
    use ResponseTrait;

    public function SingUpForm()
    {
        return view('authentication.register');
    }

    public function signUpStore(CustomerSignupRequest $request)
    {
        // dd($request->all());
        try {
            $customer = new CustomerAuth;
            $customer->customer_name=$request->customer_name;
            $customer->mobile=$request->mobile;
            // $customer->address=$request->address;
            // $customer->email=$request->email;
            $customer->image='avater.jpg';
            $customer->password=Crypt::encryptString($request->password);
            if($customer->save()){
            return redirect(route('login'));
            }else{
            return redirect()->back()->with('please try again');
            }

        }catch(Exception $e){
            // Toastr::primary('Please try Again!');
            dd($e);
        }
    }

    public function ProfileEdit()
    {
        $id=Session::get('userId');
       $customer=CustomerAuth::findOrFail($id);
    //    return $customer;
       return view('authentication.customer_update',compact('customer'));
    }

    public function AllOrderList()
    {
        $id=Session::get('userId');
       $allorder=Order::where('user_id',$id)->get();
       return view('product.allorder_list',compact('allorder'));
    }

    public function InvoiceShow($id)
    {
        $order=Order::where('id',$id)->with(['billing','orderdetails'])->get();
        // return $order;
        return view('product.invoice',['order_details' =>$order]);
    }

    public function WishlistAdd($id)
    {
        $user_id=Session::get('userId');
        if(Session::get('userId')){
           $wishlist= new Wishlist;
           $wishlist->product_id=$id;
           $wishlist->user_id=$user_id;
           $wishlist->save();
           return redirect()->back();


       }else{
        return redirect()->route('login');
       }
    }

    public function WishlistIndex()
    {
        $id=Session::get('userId');
       $wish=Wishlist::where('user_id',$id)->get();
       return view('product.wishlist-index',compact('wish'));
    }

    public function WishlistDelete($id)
    {
        $wishlist=Wishlist::findOrFail($id);
        $wishlist->delete();
        return redirect()->back();
    }


    public function update(Request $request)
    {
        try {
            $id=Session::get('userId');
            $customer=CustomerAuth::findOrFail($id);
            $customer->customer_name=$request->customer_name;
            // $customer->mobile=$request->mobile;
            $customer->address=$request->address;
            $customer->email=$request->email;
            if($request->hasFile('image')){
                $imageName = rand(111,999).time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/customer_img'), $imageName);
                $customer->image=$imageName;
            }
            $customer->save();
            request()->session()->put(
                [
                    'userId'=>$customer->id,
                    'userName'=>$customer->customer_name,
                    'shippingAddress'=>$customer->address,
                    'email'=>$customer->email,
                    'Image'=>$customer->image?$customer->image:'avater.jpg'
                ]);
            return redirect()->route('customer.dashboard');
        } catch (Exception $e) {
            // Toastr::info('Please try Again!');
            // dd($e);
        }
    }

    public function SinInForm(){
        return view('authentication.login');
    }

    public function customerLoginCheck(CustomerSigninRequest $request)
    {
        try {
            $customer = CustomerAuth::where('mobile', $request->mobile)->first();
            if ($customer) {
                if ($request->password === Crypt::decryptString($customer->password)) {
                    $this->setSession($customer);
                    return redirect()->route('customer.dashboard')->with($this->resMessageHtml(true, null, 'Successfully login'));
                } else
                    return redirect()->route('login')->with($this->resMessageHtml(false, 'error', 'wrong cradential! Please try Again'));
            } else {
                return redirect()->route('login')->with($this->resMessageHtml(false, 'error', 'wrong cradential!. Or no user found!'));
            }
        } catch (Exception $error) {
            // dd($error);
            // Toastr::info('Please try Again!');
            return redirect()->route('login')->with($this->resMessageHtml(false, 'error', 'wrong cradential!'));
        }
    }

    public function setSession($customer){
        return request()->session()->put(
                [
                    'userId'=>$customer->id,
                    'userName'=>$customer->customer_name,
                    'userEmail'=>$customer->email,
                    'shippingAddress'=>$customer->address,
                    'Phone'=>$customer->mobile,
                    'language'=>$customer->language,
                    'Image'=>$customer->image?$customer->image:'no-image.png'
                ]
            );
    }

    public function singOut(){
        request()->session()->flush();
        return redirect('login')->with($this->resMessageHtml(false,'error','successfully Logout'));
    }

}
