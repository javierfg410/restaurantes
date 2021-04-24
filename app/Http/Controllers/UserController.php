<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\RolesUser;
use App\Models\Restaurant;
use App\Models\Pictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 

class UserController extends Controller
{

    public function index()
    {
        if(Auth::user()->id == 1){
            $users = User::where('id', "!=" , 1)->get();
            
        }else{
            $users = Auth::user();
        }
        return response()->json(['status'=>'ok', 'users'=>$users],200);
    }
    //Si esta registrado muestra el perfil de usuario, si no redirecciona al login
    public function show($id){
        if(Auth::user()->id == 1){
            $users = User::where('id' , $id)->get();
        }else{
            $users = Auth::user(); 
        }
        return response()->json(['status'=>'ok', 'users'=>$users],200);
    }
    //Actualización de usuarios
    public function update($id,Request $request)
    {
    
        try{
            $validated = $request->validate([
                'password' => ['required', 'string', 'min:8'],
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
            $usuario = User::findOrFail($id);
            $usuario->update([
                'name' => $request->all()['name'],
                'lastname' => $request->all()['lastname'],
                'email' => $request->all()['email'],
                'password' => Hash::make($request->all()['password']),
            ]);
            return response()->json(['status'=>'ok', 'users'=>$usuario],200);
        }catch(exception $e){
            return response()->json(['status'=>'error', 'error'=>$e],400);
        }  
    }
    //Eliminacion de usuarios
    public function destroy($id)
    {
        try{
            if($id==1){
                return response()->json(['status'=>'error', 'description'=>'no puedes eliminar usuario admin'],400);
            }else{
                $usuario = User::where('id', $id)->first();
                if(!$usuario){
                    return response()->json(['status'=>'error', 'Description' => 'usuario no encontrado' ],404);
                }
                $rol_user= RolesUser::where('id_user', $id)->delete();
                $restaurants= Restaurant::where('id_user',$id)->get();
                foreach($restaurants as $restaurant){
                    $pictures = Pictures::where('id_restaurant',  $restaurant->id_restaurant)->get();
                    foreach($pictures as $picture){
                        File::delete($picture->path);
                        $picture->delete();
                    }
                    $restaurant->delete();
                }
                $usuario->delete();
                return response()->json(['status'=>'ok', 'description'=>'usuario eliminado correctamente'],200);
            }
        }catch(exception $e){
            return response()->json(['status'=>'error', 'error'=>$e],400);
        } 
    }

}