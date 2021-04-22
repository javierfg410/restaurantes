<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    public function index()
    {

    }
    public function getUsers()
    {
        $user = User::get();
        
        return $user;
    }
    public function getRole($id)
    {
        
        $user = User::where('id', $id)->first();
        return $user->role;
    }

}