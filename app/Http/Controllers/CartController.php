<?php

namespace App\Http\Controllers;






use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart as Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $MightAlsoLike = Product::MightAlsoLike()->get();
        return view('Pages.cart',compact('MightAlsoLike'));
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
        $duplicates = Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });
        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message','Item has already been added to your cart!');

        }
        Cart:: add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message','Item has been added to your cart!');
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
      Cart::update($id, $request->quantity);

      session()->flash('success_message','Quantity was updated successfully');
      return response()->json(['success'=>true]);
        // return $request->all();
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
        Cart::remove($id);
        return back()->with('success_message','Item has been removed successfully!');
    }
    /**
     * SwitchToSaveForLater
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SwitchToSaveForLater($id)
    {
        //

        $item =Cart::get($id);
        Cart::remove($id);
        $duplicates = Cart::instance('saveForLater')->search(function($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });
        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message','Item has already been added to your cart!');

        }
         Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message','Item has been Saved for later !');
    }
}
