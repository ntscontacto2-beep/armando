<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $table = 'rutas';

    public $timestamps = false; 

    protected $fillable = ['nombre', 'descripcion', 'geojson'];

   
    protected $casts = [
        'geojson' => 'array',
    ];
}