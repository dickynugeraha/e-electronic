<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userRegister()
    {
        // $validateInput = $request->validate([
        //     "name" => "required",
        //     "address" => "required",
        //     "age" => "required",
        //     "email" => ["required, unique:users, email, bail"],
        //     "id_card_number" => ["required", "unique:users"],
        //     "password" => "min:6",
        // ]);

        // if ($validateInput)

        // $user = User::create([
        //     "name" => "kale",
        //     "address" => "jl. jalan yuk",
        //     "age" => "22",
        //     "id_card_number" => "1234",
        //     "email" => "kale@gmail.com",
        //     "password" => bcrypt(123456),
        // ]);

        // $user->cart()->create();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userLogin(Request $input)
    {


        $user = User::where("email", $input->email)->first();

        if ($user === null) {
            return redirect()->back()->with('alert', 'User not found, please registration!');
        }
        if ($user && !Hash::check($input->password, $user->password)) {
            return redirect()->back()->with('alert', 'Password incorrect!');
        }
        if (!($user && Hash::check($input->password, $user->password))) {
            return redirect()->back()->with('alert', 'Unauthenticated!');
        }

        Session::put('userId', $user->id);

        return redirect('/product');
    }
    public function profile()
    {
        $userId = Session::get("userId");

        $user = User::where("id", $userId)->first();

        return view("profile.index", compact($user));
    }
}
