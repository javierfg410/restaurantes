<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_restaurant',
        'name',
        'address',
        'town',
        'country',
        'id_user'
    ];
    protected $primaryKey = 'id_restaurant';
    public $incrementing = false;
    public $timestamps = false;
}
