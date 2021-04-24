<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\RolesUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function create(Request $request){
/*
Codigo pensado para que si tienes un token no puedas registrarse
        if(Auth::user()){
            return response()->json([
                'message' => 'Un usuario no puede registrar usuarios nuevos'
            ], 403);

        }*/
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $userId = User::where('email', $request->email)->first();
        $role = RolesUser::create([
            'id_role' => "2",
            'id_user' =>  $userId->id
        ]);
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);

    }
}
