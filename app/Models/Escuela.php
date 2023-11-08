<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    public function tesistas()
    {
        return $this->hasMany(Tesista::class);
    }

    public function asesores()
    {
        return $this->hasMany(Asesor::class);
    }

    public function secretarias()
    {
        return $this->hasMany(Secretaria::class);
    }

    public function practicantes()
    {
        return $this->hasMany(Practicante::class);
    }
}
