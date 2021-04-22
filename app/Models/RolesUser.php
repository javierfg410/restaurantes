<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_role',
        'id_user'
    ];
    protected $primaryKey = [
        'id_role',
        'id_user'
    ];
    public $incrementing = false;
    public $timestamps = false;
}
