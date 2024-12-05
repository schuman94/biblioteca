<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Ejemplar extends Model
{
    /** @use HasFactory<\Database\Factories\EjemplarFactory> */
    use HasFactory;

    protected $table = 'ejemplares';
    protected $fillable = ['codigo', 'libro_id'];

    public function libro() {
        return $this->belongsTo(Libro::class);
    }

    public function prestamos() {
        return $this->hasMany(Prestamo::class);
    }

    public function prestado(){
        if ($this->prestamos) {
            $prestado = false;
        } elseif ($this->prestamos()->whereNull('fecha_dev')->first()) {
            $prestado = true;
        } else {
            $prestado = true;
        }
        return $prestado;
    }

    // No la estoy usando
    public static function disponibles() {
        $disponibles = Ejemplar::whereNotIn('id', function(Builder $query) {
            $query->select('ejemplar_id')
            ->from('prestamos')
            ->whereNull('fecha_dev');
        })->get();

        return $disponibles;
    }
}
