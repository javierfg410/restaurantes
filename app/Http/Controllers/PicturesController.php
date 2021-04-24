<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pictures;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class PicturesController extends Controller
{
    public function index($restaurant_id)
    {
        $pictures = Pictures::where('id_restaurant', $restaurant_id)->get();
        $restaurant = Restaurant::where('id_restaurant', $restaurant_id)->first();
        return response()->json(['status'=>'ok', 'Picture' => $pictures ],200);
    }
    //Listado de imagenes de cada restaurante
    public function show($restaurant_id,$picture_id)
    {
        $pictures = Pictures::where('id_picture', $picture_id)->get();
        $restaurant = Restaurant::where('id_restaurant', $restaurant_id)->first();
        return response()->json(['status'=>'ok', 'Picture' => $pictures ],200);
    }
  
    //Añadir Imagenes nuevas
    public function store($id,Request $request)
    {
        //return response()->json(['status'=>'ok', 'Picture' => $request->file('urlfoto') ],200);
        $fotoData= $request->all();
        $pictures = Pictures::where('id_restaurant', $id)->get();
        //solo guarda la foto si existe el fichero, y no hay mas de 5 imagenes en ese restaurante
        if ($request->hasFile('urlfoto') && $pictures->count() < 5){
            $foto=new Pictures($request->all());
            $file           = $request->file("urlfoto");
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            //se crea una carpeta con el ID del restaurante, y se guarda la imagen
            $file->move(public_path("img/".$id."/"),$pictures->count().".".$extension);
            $foto->url    = $pictures->count().".".$extension;
            $foto->path    = "img/" . $id. "/" . $pictures->count().".".$extension ;
            $foto->id_restaurant    = $id;
            $foto->save();
            return response()->json(['status'=>'ok', 'Picture' => $foto ],200);
        }else{
            return response()->json(['status'=>'error', 'Description' => 'se ha superado el numero de imagenes por restaurante' ],401);
        }
        
    }
    //elimina Imagenes
    public function destroy($restaurant_id,$picture_id)
    {
        if(Auth::user()->id != 1){
            $restaurant = Restaurant::where('id_user', Auth::user()->id )->where('id_restaurant',$restaurant_id )->first();
            if(!$restaurant){
                return response()->json(['status'=>'error', 'error'=>'no tiene permisos'],401);
            }
        }
            
        $pictures = Pictures::find($picture_id);
        if(!$pictures){
            return response()->json(['status'=>'error', 'Description' => 'Imagen no encontrada' ],404);
        }
        File::delete($pictures->path);
        $pictures -> delete();
        return response()->json(['status'=>'ok', 'Description' => 'Imagen borrada correctamente' ],200);
    }

}

