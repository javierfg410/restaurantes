<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class RestaurantController extends Controller
{
    
    public function index()
    {
        $restaurant = Restaurant::where('id_user', Auth::user()->id)->get();
        return view('restaurant.index' , ['restaurantes' => $restaurant ]);
    }
  
       
    public function addRess(Request $request)
    {
        $restaurant = Restaurant::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'town' => $request['town'],
            'country' => $request['country'],
            'id_user' => Auth::user()->id
        ]);
        return redirect("/restaurante");
    }
    public function editRess(Request $request)
    {

        $restaurant = Restaurant::where('id_restaurant', $request['id_restaurant'])
        ->where('id_user', Auth::user()->id )
        ->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'town' => $request['town'],
            'country' => $request['country']
        ]);
        return redirect("/restaurante");
    }
    public function delRess($id)
    {
        $restaurant = Restaurant::where('id_user', Auth::user()->id )->where('id_restaurant',$id )->first();
        $restaurant->delete();
        return redirect("/restaurante");
    }

}

