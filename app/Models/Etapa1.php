<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa1 extends Model
{
    use HasFactory;

    public function expediente(){
        return $this->hasOne(Expediente::class);
    }
}
