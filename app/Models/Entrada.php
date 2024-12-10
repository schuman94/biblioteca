<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    /** @use HasFactory<\Database\Factories\EntradaFactory> */
    use HasFactory;

    protected $fillable = ['proyeccion_id'];

    public function proyeccion() {
        return $this->belongsTo(Proyeccion::class);
    }
}
