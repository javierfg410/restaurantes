<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\RolesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {

    }
    public function getUsers()
    {
        if(Auth::user()->id == 1){
            $users = User::get();
        
            return view('user.list', ['usuarios', $users]);
        }else{
            return view('user.perfil');
        }
        
    }
    public function getRole($id)
    {
        
        $user = User::where('id', $id)->first();
        return $user->role;
    }
    public function perfil()
    {

        return view('user.perfil');
    }
    public function setUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $usuario = User::where('id', Auth::user()->id)->first();
        $newUsuario = $request->all();
        $usuario->update(
            [
                'name' => $newUsuario['name'],
                'lastname' => $newUsuario['lastname'],
                'email' => $newUsuario['email']
            ]
        );
        return view('home');
    }
    public function delUser()
    {
        $usuario = User::where('id', Auth::user()->id)->first();
        $rol_user= RolesUser::where('id_user', Auth::user()->id)->delete();

        $usuario->delete();
        return redirect(view('auth.login'));
    }

}