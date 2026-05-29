<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';


    public $timestamps = false;

    protected $fillable = ['local_id', 'dia', 'abre', 'cierra'];


    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
    }
}