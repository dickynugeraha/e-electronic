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
        $shippings = Shipping::all();

        if ($cart === null) {
            $cart_items = [];
            return view("cart.index", compact("cart_items", "shippings"));
        }
        $cart_items = count($cart->products) > 0 ? $cart->products : [];
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
        $cart = Cart::where("user_id", "=", $userId);
        $userCart = $cart->first();
        $isAvailableProd = false;


        if ($userCart == null) {
            $cart = Cart::create(["user_id" => $userId]);
            $cart->products()->attach([
                $request->product_id => [
                    "quantity" => $request->quantity,
                    "description" => $request->description,
                    "price_per_item" => ($request->price * $request->quantity)
                ]
            ]);
        } else {
            $cartProds = $cart->with("products")->first();
            foreach ($cartProds->products as $prod) {
                if ($prod->id == $request->product_id) {
                    $isAvailableProd = true;
                    $userCart->products()->sync([
                        $request->product_id => [
                            "description" => $request->description,
                            "quantity" => $prod->pivot->quantity += $request->quantity,
                            "price_per_item" => $prod->pivot->price_per_item += $request->price * $request->quantity
                        ]
                    ]);
                }
            }
            if (!$isAvailableProd) {
                $userCart->products()->attach([
                    $request->product_id => [
                        "quantity" => $request->quantity,
                        "description" => $request->description,
                        "price_per_item" => ($request->price * $request->quantity)
                    ]
                ]);
            }
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
