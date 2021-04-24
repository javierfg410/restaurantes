<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use App\Models\Restaurant;
use App\Models\Pictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class RestaurantController extends Controller
{
    //Redirecciona al listado de restaurantes
    public function index()
    {
        $restaurant = Restaurant::get();

        return response()->json(['status'=>'ok', 'Restaurant' => $restaurant ],200);
    }
  
    //Añadir restaurantes
    public function store(Request $request)
    {
        
        $user= Auth::user();
        if($user->id==1){
            return response()->json(['status'=>'Forbidden', 'description' =>'Usuario Admin no puede crear restaurantes'],403);
        }else{
            $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'town' => 'required|string',
                'country' => 'required|string',
    
            ]);
            $restaurant = Restaurant::create([
                'name' => $request['name'],
                'address' => $request['address'],
                'town' => $request['town'],
                'country' => $request['country'],
                'id_user' => Auth::user()->id
            ]);
            return response()->json(['status'=>'ok', 'Restaurant' => $restaurant ],200);
        }
        
        

    }
    //mostrar restaurantes
    public function show($id)
    {
        $restaurant = Restaurant::where('id_restaurant',$id )->first();
        return response()->json(['status'=>'ok', 'Restaurant' => $restaurant ],200);
    }
    //actualizar restaurantes
    public function update($id,Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'town' => 'required|string',
                'country' => 'required|string',
            ]);
            //condicion creada para evitar que otro usuario que no sea admin pueda editar datos de restaurantes
            //que no sean suyos
            if(Auth::user()->id ==1){
                $restaurant = Restaurant::where('id_restaurant', $id)
                ->update([
                    'name' => $request['name'],
                    'address' => $request['address'],
                    'town' => $request['town'],
                    'country' => $request['country']
                ]);
            }
            else{
                $restaurant = Restaurant::where('id_restaurant', $id)
                ->where('id_user', Auth::user()->id )
                ->update([
                    'name' => $request['name'],
                    'address' => $request['address'],
                    'town' => $request['town'],
                    'country' => $request['country']
                ]);
                if(!$restaurant){
                    return response()->json(['status'=>'error', 'error'=>'Restaurante no encontrado'],400);
                }
            }
            return response()->json(['status'=>'ok', 'Restaurant' => $restaurant ],200);
        }catch(exception $e){
            return response()->json(['status'=>'error', 'error'=>$e],400);
        }  
       
    }
    //Eliminación de restauratnes
    public function destroy($id)
    {
        try{
            //condicion creada para evitar que otro usuario que no sea admin pueda eliminar restaurantes
            //que no sean suyos

            //Tambien borra todas las imagenes asignadas a cada restaurante
            if(Auth::user()->id ==1){
                $restaurant = Restaurant::where('id_restaurant',$id )->first();
                if(!$restaurant){
                    return response()->json(['status'=>'error', 'Description' => 'Restaurante no encontrado' ],404);
                }
                $pictures = Pictures::where('id_restaurant',  $id)->get();
                foreach($pictures as $picture){
                    File::delete($picture->path);
                    $picture->delete();
                }
                $restaurant->delete();
            }
            else
            {
                $restaurant = Restaurant::where('id_user', Auth::user()->id )->where('id_restaurant',$id )->first();
                if(!$restaurant){
                    return response()->json(['status'=>'error', 'error'=>'Restaurante no encontrado'],400);
                }
                if($restaurant){
                    $pictures = Pictures::where('id_restaurant',  $id)->get();
                    foreach($pictures as $picture){
                        File::delete($picture->path);
                        $picture->delete();
                    }
                }
                $restaurant->delete();
            }
            return response()->json(['status'=>'ok', 'Description' => 'restaurante eliminado correctamente' ],200);
        }catch(exception $e){
            return response()->json(['status'=>'error', 'error'=>$e],400);
        } 
    }

}

