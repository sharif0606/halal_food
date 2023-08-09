<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('db_items')->where('is_feature', '1')->select('id','item_name','sales_price','item_image','is_feature')->paginate(12);
        // return $product;
        return view('product.product',compact('product'));
    }
    public function topProduct()
    {
        $product = DB::table('db_items')->where('is_top', '1')->select('id','item_name','sales_price','item_image','is_feature')->paginate(12);
        // return $product;
        return view('product.product',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productList($childcategory_id)
    {
        $product = DB::table('db_items')->where('childcategory_id', $childcategory_id)->select('id','item_name','sales_price','item_image','is_feature')->paginate(12);
        // return $product;
        return view('product.product',compact('product'));
    }

    public function singleProduct($id)
    {
        // $show_product = Product::all()->where('id',$id);
        // $show_product = DB::table('db_items')->join('db_units','db_items.unit_id','=','db_units.id')->where('db_items.id',$id)->first();
        $show_product = DB::table('db_items')->where('id',$id)->first();
        $unit = DB::table('db_units')->where('id',$show_product->unit_id)->first();
        $brands = DB::table('db_brands')->where('id',$show_product->brand_id)->first();
        $childcat = DB::table('db_childcategory')->where('id',$show_product->childcategory_id)->first();
        $related_products = DB::table('db_items')->whereNot('id', $id)->select('id', 'item_name', 'sales_price', 'item_image', 'is_feature')->limit(4)->get();
        // print_r($show_product);
        // die();
        return view('product.singleProduct',compact('show_product','related_products','unit','brands','childcat'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
