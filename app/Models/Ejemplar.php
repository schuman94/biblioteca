<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function disponibles() {
        $query = "
            SELECT ejemplares.*
            FROM ejemplares
            LEFT JOIN prestamos ON prestamos.ejemplar_id = ejemplares.id
            WHERE (prestamos.id IS NULL OR NOW() > prestamos.fecha_hora + interval '1 month')
        ";

        return DB::select($query);
    }
}
