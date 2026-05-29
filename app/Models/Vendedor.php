<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;


    protected $table = 'vendedores';

    protected $fillable = ['nombre', 'email', 'telefono', 'redes', 'password_hash', 'foto'];

    protected $casts = [
        'redes' => 'array',
    ];

    public function locales()
    {
        return $this->hasMany(Local::class, 'vendedor_id');
    }
}