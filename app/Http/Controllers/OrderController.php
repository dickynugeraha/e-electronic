<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Session::get("userId");
        $orders = Order::where("user_id", $userId)->with("products")->get();

        if (count($orders) === 0) {
            $orders = [];
            return view("order.index", compact("orders"));
        }
        return view("order.index", compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productIds = [];

        $userId = Session::get("userId");


        $totalAmount = explode(" ", $request->total_amount)[0];
        $shipping = Shipping::find($request->shipping);
        $totalAmount += $shipping->price;

        $order = Order::create([
            "user_id" => $userId,
            "total_amount" => $totalAmount,
            "shipping_id" => $request->shipping,
        ]);

        $cart = Cart::where("user_id", $userId);
        $products = $cart->with("products")->first()->products;
        foreach ($products as $product) {
            $order->products()->attach([
                $product->id => [
                    "quantity" => $product->pivot->quantity,
                    "price_per_item" => $product->pivot->price_per_item,
                    "description" => $product->pivot->description,
                ],
            ]);
        }


        if ($cart) {
            $cart->delete();
        }

        return $order;

        // return view("/order/{{$order->id}}/{{$userId}}");

        return redirect()->to("order/" . $order->id . "/" . $userId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_id, $user_id)
    {
        $order_items = [];
        $order = Order::find($order_id)
            ->where("user_id", "=", $user_id)
            ->with("products")
            ->first();

        if ($order === null) {
            $order_items = [];
            return view("order.detail", compact("order_items"));
        }
        $order_items = count($order->products) > 0 ? $order->products : [];
        return $order_items;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
