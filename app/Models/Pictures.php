<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_picture',
        'url',
        'path',
        'id_restaurant'
    ];
    protected $primaryKey = 'id_picture';
    public $incrementing = false;
    public $timestamps = false;
}
