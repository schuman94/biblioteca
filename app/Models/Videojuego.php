<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    protected $fillable = ['titulo', 'desarrollador'];

    public function users() {
        return $this->belongsToMany(User::class)
            ->withPivot('cantidad');
    }
}
