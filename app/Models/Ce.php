<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ce extends Model
{
    protected $table = 'ccee';

    public function notas() {
        return $this->hasMany(Nota::class, 'ccee_id');
    }
}
