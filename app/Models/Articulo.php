<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    /** @use HasFactory<\Database\Factories\ArticuloFactory> */
    use HasFactory;

    protected $fillable = ['codigo', 'descripcion', 'precio'];

    public function facturas() {
        return $this->belongsToMany(Factura::class)
            ->withPivot('cantidad');
    }

}
