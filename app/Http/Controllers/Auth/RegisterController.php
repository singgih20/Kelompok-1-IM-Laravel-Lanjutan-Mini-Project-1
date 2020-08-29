<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {

        if ($request->has('roles')) {
            $roles = request('roles');
        } else {
            $roles = "guest";
        }

        User::create([
            'name' => request('name'),
            'username' => request('username'),
            'phone' => request('phone'),
            'password' => bcrypt(request('password')),
            'roles' => $roles
        ]);

        return response()->json(['message'=>'Thanks, you are registered.']);
    }
}
