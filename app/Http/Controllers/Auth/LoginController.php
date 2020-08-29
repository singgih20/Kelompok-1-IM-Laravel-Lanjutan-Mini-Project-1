<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!$token = auth()->attempt($request->only('username', 'password'))) {
            return response()->json(["message"=>"You're authorize credentials are incorrect!"], 401);
        }

        return response()->json(compact('token'));
    }
}
