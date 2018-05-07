<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    // public function index(){
    // 	$title = 'Welcome to Yutela!';
    // 	return view('Pages.index', compact('title'));
    // }
    public function index(){
    	// $title = 'Welcome to Yutela!';
    	// return view('Pages.index');
    	$products = Product::inRandomOrder()->take(8)->get();

    	return view('pages.Landing-page',compact('products'));
    }
    public function view(){
    	return ('Services');
    }
}
