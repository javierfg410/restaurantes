<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_role',
        'name',
        'description'
    ];
    protected $primaryKey = 'id_role';

    public function user()
    {
        return $this->belongsToMany(  User::class, 'roles_users','id_role','id_user');
    }
}
