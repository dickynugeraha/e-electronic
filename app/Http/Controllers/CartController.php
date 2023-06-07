<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart_items = [];

        $userId = Session::get("userId");
        $cart = Cart::where("user_id", "=", $userId)
            ->with("products")
            ->first();

        if ($cart === null) {
            $cart_items = [];
            return view("cart.index", compact("cart_items"));
        }
        $cart_items = count($cart->products) > 0 ? $cart->products : [];
        $shippings = Shipping::all();
        return view("cart.index", compact("cart_items", "shippings"));
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
        $userId = Session::get("userId");

        $cart = Cart::where("user_id", $userId)->first();

        if ($cart === null) {
            $cart = Cart::create(["user_id" => $userId]);
            $cart->products()->attach([
                $request->product_id => [
                    "quantity" => $request->quantity,
                    "description" => $request->description,
                    "price_per_item" => ($request->price * $request->quantity)
                ]
            ]);
        } else {
            $product = $cart->products()->first();
            // dd($product->pivot->description);
            $cart->products()->sync([
                $request->product_id => [
                    "description" => $request->description,
                    "quantity" => $product->pivot->quantity += $request->quantity,
                    "price_per_item" => $product->pivot->price_per_item += $request->price * $request->quantity
                ]
            ]);
        }


        return redirect()->back()->with('alert', 'Successfully update or create cart product!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $userId = Session::get("userId");
        $cart = Cart::where("user_id", $userId)->first();

        $cart->products()->sync([
            $request->product_id => [
                "description" => $request->description,
                "quantity" => $request->quantity,
                "price_per_item" => $request->price * $request->quantity
            ]
        ]);

        return redirect()->back()->with('alert', 'Successfully update cart product!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $userId = Session::get("userId");
        $cart = Cart::where("user_id", $userId)->first();

        $cart->products()->detach([$productId]);

        $cartUpdate = Cart::where("user_id", $userId)->with("products")->first();

        // dd($cartUpdate);

        if (count($cartUpdate->products) == 0) {
            Cart::where("user_id", $userId)->delete();
        }

        return redirect()->back()->with('alert', 'Successfully delete cart product!');
    }
}
