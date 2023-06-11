<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/login', function () {
    $userId = Session::get("userId");
    if ($userId) {
        return redirect("/product");
    }
    return view('auth.user');
});
Route::get('/logout', function () {
    $userId = Session::get("userId");
    $admin = Session::get("isAdmin");
    if ($userId || $admin) {
        Session::forget("userId");
        Session::forget("isAdmin");
        return redirect("/login");
    }
});
Route::post("login-user", [AuthController::class, "userLogin"]);
Route::post("register", [AuthController::class, "userRegister"]);
//profile
Route::get("profile", [AuthController::class, "profile"]);
Route::post("profile/update", [AuthController::class, "update"]);
// product
Route::apiResource("/product", ProductController::class);
// cart
Route::get('cart', [CartController::class, "index"]);
Route::post("cart", [CartController::class, "store"]);
Route::get("cart/{id}/delete", [CartController::class, "destroy"]);
Route::post("cart/update", [CartController::class, "update"]);
// order
Route::post("order", [OrderController::class, "store"]);
Route::get("orders", [OrderController::class, "index"]);
Route::get("order/{order_id}", [OrderController::class, "show"]);
Route::post("order/upload_foto_payment", [OrderController::class, "uploadProofPayment"]);
// admin
Route::get("admin/products", [ProductController::class, "indexAdmin"]);
Route::get("product/{prodId}/delete", [ProductController::class, "destroy"]);
Route::apiResource("shipping", ShippingController::class);
Route::get("admin/shippings", [ShippingController::class, "index"]);
Route::get("admin/customers", [AuthController::class, "customers"]);
Route::get("user/{id}/delete", [AuthController::class, "destroy"]);
Route::get("orders/{status}", [OrderController::class, "showByStatus"]);
Route::get("order/{orderId}/{userId}", [OrderController::class, "showOrderByUser"]);
Route::post("order/update-status", [OrderController::class, "updateStatus"]);
