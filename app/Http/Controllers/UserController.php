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
    
  //Listar usuarios para el Admin, si no tiene ese rol, redirecciona al perfil de usuario
    public function getUsers()
    {
        if(Auth::user()->id == 1){
            $users = User::where('id', "!=" , 1)->get();
            return view('user.list', ['usuarios'=> $users]);
        }else{
            return view('user.perfil');
        }
        
    }
    //Si esta registrado muestra el perfil de usuario, si no redirecciona al login
    public function show($id)
    {
        if( isset( Auth::user()->id ) )
            return view('user.perfil');
        else
            return view('auth.login');
    }
    //Actualización de usuarios
    public function update(Request $request)
    {
        $newUsuario = $request->all();
        //Si en la respuesta esta el atributo contraseña, solo guarda la contraseña
        if(isset($newUsuario['password'])){
            $validated = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $usuario = User::where('id', $newUsuario['id'])->first();
            $usuario->update(
            [
                'password' => Hash::make($newUsuario['password']),
            ]);
        }
        //Si en la respuesta NO esta el atributo contraseña, guarda los demas datos
        else
        {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
            $newUsuario = $request->all();
            $usuario = User::where('id', $newUsuario['id'])->first();
            $usuario->update(
                [
                    'name' => $newUsuario['name'],
                    'lastname' => $newUsuario['lastname'],
                    'email' => $newUsuario['email']
                ]
            );
        }
        
        //Si el que ha hecho la actualización es el admin, redirecciona al listado de usuarios
        if(Auth::user()->id == 1){
            $users = User::where('id', "!=" , 1)->get();
            return view('user.list', ['usuarios'=> $users]);
        }
        else
        {
            //Si es un Cliente despues de actualizar los datos, redirecciona a restaurantes
            return redirect("/restaurants");
        }

        
    }
    //Eliminacion de usuarios
    public function delete($id)
    {
        //si no esta registrado, rediciona al Login
        if( !isset( Auth::user()->id ) ){
            return view('auth.login');
        }
        $usuario = User::where('id', $id)->first();
        $rol_user= RolesUser::where('id_user', $id)->delete();

        //Si es admin, elimina al usuario, y redirecciona a la lista de usuarios
        if(Auth::user()->id == 1){
            $usuario->delete();
            $users = User::where('id', "!=" , 1)->get();
            return redirect("/users");
        }
        else{
            //si era un cliente, redirecciona al login
            $usuario->delete();
            return view('auth.login');
        }
        
    }

}