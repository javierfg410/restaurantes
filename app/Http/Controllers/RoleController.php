<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    
    public function index()
    {

    }
    public function getRole()
    {
        $role = Role::get();
        
        return $role;
    }

    public function getUser($id)
    {
        $role = Role::where('id_role', $id)->first();
        return $role->user;
    }

}

