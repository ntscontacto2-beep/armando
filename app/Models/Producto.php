<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre', 
        'descripcion', 
        'cantidad', 
        'stock_minimo', 
        'precio_costo', 
        'precio_venta'
    ];

    public function necesitaReabastecer()
    {
        return $this->cantidad <= $this->stock_minimo;
    }
}