<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Shipping;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Session::get("userId");
        $status = $request->get("status");
        $orders = Order::where("user_id", "=", $userId)->with("products")->get();

        if ($status != "" && $status != "all") {
            $orders = Order::where("user_id", "=", $userId)
                ->where("status", "=", $status)
                ->with("products")->get();
        }

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
        $userId = Session::get("userId");


        $totalAmount = explode(" ", $request->total_amount)[0];
        $shipping = Shipping::find($request->shipping);
        $totalAmount += $shipping->price;

        $order = Order::create([
            "user_id" => $userId,
            "total_amount" => $totalAmount,
            "shipping_id" => $request->shipping,
        ]);

        $cart = Cart::where("user_id", "=", $userId);
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

        return redirect()->to("order/" . $order->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function uploadProofPayment(Request $request)
    {
        $request->validate([
            'payment_photo' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $order = Order::find($request->order_id);

        $image = $request->file('payment_photo');
        $image_name = time() . "." . $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/payment_photo');
        $image->move($destinationPath, $image_name);

        $order->payment_photo = $image_name;
        $order->status = "checking";
        $order->save();

        return redirect()->back()->with('alert', 'Successfully upload payment photo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        $order = Order::where("id", "=", $order_id)
            ->with("products")
            ->first();

        if ($order === null || count($order->products) == 0) {
            $order = [];
            return view("order.detail", compact("order"));
        }
        return view("order.detail", compact("order"));
    }

    public function showByStatus($status)
    {
        $orders = Order::where("status", "=", $status)->with(["products", "user"])->get();
        return view("order.status", compact("orders", "status"));
    }

    public function showOrderByUser($orderId, $userId)
    {
        $order = Order::where("id", "=", $orderId)
            ->where("user_id", "=", $userId)
            ->with("products")
            ->first();

        return view("order.detail_user", compact("order"));
    }

    public function updateStatus(Request $request)
    {
        Order::where("id", "=", $request->order_id)->update(["status" => $request->status]);

        return redirect()->back()->with("alert", "Successfully updated status!");
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
