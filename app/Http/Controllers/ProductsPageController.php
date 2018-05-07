<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class ProductsPageController extends Controller
{
    //
    // public function index(){
    // 	$title = 'Welcome to Yutela!';
    // 	return view('Pages.index', compact('title'));
    // }
    public function index(){
    	// $title = 'Welcome to Yutela!';
    	// return view('Pages.index');
    	$products = Product::inRandomOrder()->take(20)->get();
       

    	return view('pages.Products',compact('products'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $MightAlsoLike = Product::where('slug', '!=', $slug)->MightAlsoLike()->get();
        return view('Pages.Product-Details',compact('product','MightAlsoLike'));
    }

   
}
