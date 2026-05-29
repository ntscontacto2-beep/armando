<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locales';


    public $timestamps = false;

    protected $fillable = [
        'vendedor_id', 'nombre', 'slug', 'categoria', 
        'ubicacion', 'descripcion', 'lat', 'lng', 'visitas',
        'dias_laborales',
    'hora_apertura',
    'hora_cierre',
    'latitud',
    'longitud',
    ];

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

  
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'local_id');
    }
}