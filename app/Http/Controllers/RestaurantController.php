<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

        return view('restaurant.index' , ['restaurantes' => $restaurant ]);
    }
  
    //Añadir restaurantes
    public function store(Request $request)
    {
        //Campos obligatorios en el HTML || añadir validator en un futuro
        $restaurant = Restaurant::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'town' => $request['town'],
            'country' => $request['country'],
            'id_user' => Auth::user()->id
        ]);
        return redirect("/restaurants");
    }
    //mostrar restaurantes
    public function show($id)
    {
        $restaurant = Restaurant::where('id_restaurant',$id )->first();
        return redirect("/restaurants");
    }
    //actualizar restaurantes
    public function update(Request $request)
    {
        //condicion creada para evitar que otro usuario que no sea admin pueda editar datos de restaurantes
        //que no sean suyos
        if(Auth::user()->id ==1){
            $restaurant = Restaurant::where('id_restaurant', $request['id_restaurant'])
            ->update([
                'name' => $request['name'],
                'address' => $request['address'],
                'town' => $request['town'],
                'country' => $request['country']
            ]);
        }
        else{
            $restaurant = Restaurant::where('id_restaurant', $request['id_restaurant'])
            ->where('id_user', Auth::user()->id )
            ->update([
                'name' => $request['name'],
                'address' => $request['address'],
                'town' => $request['town'],
                'country' => $request['country']
            ]);
        }
        return redirect("/restaurants");
    }
    //Eliminación de restauratnes
    public function delete($id)
    {
        //condicion creada para evitar que otro usuario que no sea admin pueda eliminar restaurantes
        //que no sean suyos

        //Tambien borra todas las imagenes asignadas a cada restaurante
        if(Auth::user()->id ==1){
            $restaurant = Restaurant::where('id_restaurant',$id )->first();
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
            if($restaurant){
                $pictures = Pictures::where('id_restaurant',  $id)->get();
                foreach($pictures as $picture){
                    File::delete($picture->path);
                    $picture->delete();
                }
            }
            $restaurant->delete();
        }
        return redirect("/restaurants");
    }

}

