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
    public function userRegister(Request $request)
    {
        $user = User::where(function ($query) use ($request) {
            $query->where("email", "=", $request->email)
                ->orWhere("id_card_number", "=", $request->id_card_cumber);
        })->first();

        if ($user) {
            return redirect()->back()->with('alert', 'User has been user, please use another email or id card number!');
        }
        if ($request->password !== $request->passwordConfirm) {
            return redirect()->back()->with('alert', 'Passsword not match!');
        }

        $image = $request->file('profile_photo');
        $image_name = time() . "." . $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/profile_photo');
        $image->move($destinationPath, $image_name);

        $newUser = User::create([
            "name" => $request->name,
            "address" => $request->address,
            "age" => $request->age,
            "profile_photo" => $image_name,
            "id_card_number" => $request->id_card_number,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        Session::put("userId", $newUser->id);

        return redirect("/product");
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

        if ($user->is_admin) {
            Session::put("isAdmin", true);
            return redirect("/admin/products");
        }

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

        return view("profile.index", compact("user"));
    }

    public function update(Request $request)
    {
        User::where("id", "=", $request->user_id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "age" => $request->age,
            "address" => $request->address,
            "id_card_number" => $request->id_card_number,
        ]);

        return redirect()->back()->with('alert', 'Successfully update profile!');
    }
}
