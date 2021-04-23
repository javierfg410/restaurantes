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
    //Listado de imagenes de cada restaurante
    public function show($restaurant_id)
    {
        $pictures = Pictures::where('id_restaurant', $restaurant_id)->get();
        $restaurant = Restaurant::where('id_restaurant', $restaurant_id)->first();
        return view('pictures.index' , ['pictures' => $pictures , 'restaurant' => $restaurant ]);
    }
  
    //Añadir Imagenes nuevas
    public function store(Request $request)
    {
        $fotoData= $request->all();
        $pictures = Pictures::where('id_restaurant', $fotoData["id_restaurant"])->get();
        //solo guarda la foto si existe el fichero, y no hay mas de 5 imagenes en ese restaurante
        if ($request->hasFile('urlfoto') && $pictures->count() < 5){
            $foto=new Pictures($request->all());
            $file           = $request->file("urlfoto");
            $nombrearchivo  = $file->getClientOriginalName();
            //se crea una carpeta con el ID del restaurante, y se guarda la imagen
            $file->move(public_path("img/".$fotoData["id_restaurant"]."/"),$nombrearchivo);
            $foto->url    = $nombrearchivo;
            $foto->path    = "img/" . $fotoData["id_restaurant"] . "/" . $nombrearchivo ;
            $foto->id_restaurant    = $fotoData["id_restaurant"];
            $foto->save();
        }
        $pictures = Pictures::where('id_restaurant', $fotoData["id_restaurant"])->get();
        return redirect()->action( [PicturesController::class, 'show' ], ['restaurant_id' => $fotoData["id_restaurant"] ]);
    }
    //elimina Imagenes
    public function delete($restaurant_id,$picture_id)
    {
        $pictures = Pictures::find($picture_id);
        File::delete($pictures->path);
        $pictures -> delete();
        return redirect()->action( [PicturesController::class, 'show' ], ['restaurant_id' => $restaurant_id ]);
    }

}

