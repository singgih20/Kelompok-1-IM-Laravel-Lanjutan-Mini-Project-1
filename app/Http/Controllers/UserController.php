<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($user->id);
        $user->update([
            'name' => request('name'),
            'username' => request('username'),
            'address' => request('address'),
            'phone' => request('phone'),
            'password' => bcrypt(request('password'))
        ]);

        // dd('here');
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ubahStatus(Request $request)
    {
        // dd(Auth::user()->id);

        User::where('id', request('id'))
            ->update([
                'status' => request('status'),
            ]);

        $a = User::where('id', request('id'))->first();

        return response()->json(['status' => 'success', 'data' => $a]);
    }
}
