<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function alumno() {
        return $this->belongsTo(Alumno::class);
    }

    public function ce() {
        return $this->belongsTo(Ce::class, 'ccee_id');
    }
}
