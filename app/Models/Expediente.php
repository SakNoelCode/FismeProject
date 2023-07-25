<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    public function etapa1(){
        return $this->belongsTo(Etapa1::class);
    }
    public function etapa2(){
        return $this->belongsTo(Etapa2::class);
    }
    public function proyectos(){
        return $this->belongsTo(Proyecto::class);
    }
}
