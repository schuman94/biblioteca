<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    /** @use HasFactory<\Database\Factories\PeliculaFactory> */
    use HasFactory;

    protected $fillable = ['titulo'];

    public function proyecciones() {
        return $this->hasMany(Proyeccion::class);
    }

    public function entradas() {
        return $this->hasManyThrough(Entrada::class, Proyeccion::class);
    }
}
