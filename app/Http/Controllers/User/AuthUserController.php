<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthUserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back();
        }
        $user = User::where(['email' => $request->email], ['password' => $request->password])->first();
        $credentials = $request->only('email', 'password');
        if ($user->type == 2) {
            if (Auth::attempt($credentials)) {
                return redirect()->route('orders');
            }
        } else {
            return redirect()->back();
        }
    }
}
