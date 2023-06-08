<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
    if ($userId) {
        Session::forget("userId");
        return redirect("/login");
    }
});
Route::post("/login-user", [AuthController::class, "userLogin"]);
Route::get("user-register", [AuthController::class, "userRegister"]);
//profile
Route::get("profile", [AuthController::class, "profile"]);
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
