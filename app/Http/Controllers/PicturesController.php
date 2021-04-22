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
    
    public function index($id)
    {
        $pictures = Pictures::where('id_restaurant', $id)->get();
        $restaurant = Restaurant::where('id_restaurant', $id)->first();
        return view('pictures.index' , ['pictures' => $pictures , 'restaurant' => $restaurant ]);
    }
  
       
    public function addPict(Request $request)
    {
        
         
        $fotoData= $request->all();
        $pictures = Pictures::where('id_restaurant', $fotoData["id_restaurant"])->get();
        if ($request->hasFile('urlfoto') && $pictures->count() < 5){
            $foto=new Pictures($request->all());
            $file           = $request->file("urlfoto");
            //$nombrearchivo  = str_slug($request->slug).".".$file->getClientOriginalExtension();
            $nombrearchivo  = $file->getClientOriginalName();

            $file->move(public_path("img/".$fotoData["id_restaurant"]."/"),$nombrearchivo);
            $foto->url    = $nombrearchivo;
            $foto->path    = "img/" . $fotoData["id_restaurant"] . "/" . $nombrearchivo ;
            $foto->id_restaurant    = $fotoData["id_restaurant"];
            $foto->save();
        }
        

        $pictures = Pictures::where('id_restaurant', $fotoData["id_restaurant"])->get();

        //return view('pictures.index' , ['pictures' => $pictures , 'id_restaurant' => $fotoData["id_restaurant"] ]);
        return redirect()->action( [PicturesController::class, 'index' ], ['id' => $fotoData["id_restaurant"] ]);
        /*
        $restaurant = Restaurant::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'town' => $request['town'],
            'country' => $request['country'],
            'id_user' => Auth::user()->id
        ]);
        return redirect("/restaurante");*/
    }
    
    public function delPict($id)
    {
        $pictures = Pictures::find($id);
        $restaurant = $pictures->id_restaurant;
        
        File::delete($pictures->path);
        $pictures -> delete();
        return redirect()->action( [PicturesController::class, 'index' ], ['id' => $restaurant ]);
        /*
        $restaurant = Restaurant::where('id_user', Auth::user()->id )->where('id_restaurant',$id )->first();
        $restaurant->delete();
        return redirect("/restaurante");
        */
    }

}

