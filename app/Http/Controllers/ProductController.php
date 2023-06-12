<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Session::get("userId");
        if (!$userId) {
            return redirect("/login");
        }

        $type = $request->get("type");
        $products = Product::where("is_available", "=", "1")->get();

        if ($type != "" && $type != "all") {
            $products = Product::where("type", "=", $type)
                ->where("is_available", "=", "1")
                ->get();
        }

        return view("product.index", compact("products"));
    }

    public function indexAdmin()
    {
        $isAdmin = Session::get("isAdmin");

        if (!$isAdmin) {
            return redirect("/login");
        }

        $products = Product::all();

        return view("product.products_admin", compact("products"));
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
        $image = $request->file('product_photo');
        $image_name = time() . "." . $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/product_photo');
        $image->move($destinationPath, $image_name);

        Product::create([
            "title" => $request->title,
            "type" => $request->type,
            "description" => $request->description,
            "price" => $request->price,
            "product_photo" => $image_name,
        ]);

        return redirect()->back()->with('alert', 'Successfully add new product!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where("id", "=", $id)->first();

        return view("product.detail", compact("product"));
    }

    // public function showByType(Request $request)
    // {
    //     $type = $request->get("type");

    //     $products = Product::where("type", "=", $type)
    //         ->where("is_available", "=", "1")
    //         ->get();

    //     if ($type == "all") {
    //         $products = Product::where("is_available", "=", "1")->get();
    //     }

    //     return view("product.index", compact("products"));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::where("id", "=", $request->product_id);
        $image = $request->file('product_photo');
        $image_name = "";

        if ($request->product_photo != null) {
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/product_photo');
            $image->move($destinationPath, $image_name);

            $old_image = $product->first()->product_photo;
            $image = public_path('uploads/product_photo/') . $old_image;
            if (file_exists($image)) @unlink($image);
        } else {
            $image_name = $product->first()->product_photo;
        }

        $product->update([
            "title" => $request->title,
            "type" => $request->type,
            "description" => $request->description,
            "price" => $request->price,
            "product_photo" => $image_name,
            "is_available" => $request->is_available,
        ]);

        return redirect()->back()->with('alert', 'Successfully updated product!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($prodId)
    {
        $product = Product::where("id", "=", $prodId);

        $fileName = $product->first()->product_photo;

        $image = public_path('uploads/product_photo/') . $fileName;

        if (file_exists($image)) @unlink($image);

        $product->delete();
        return redirect()->back()->with('alert', 'Successfully delete product!');
    }
}
