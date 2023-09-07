<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function secretarias(){
        return $this->hasMany(Secretaria::class);
    }

    public function expedientes(){
        return $this->hasMany(Expediente::class);
    }
}
