<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practicante extends Model
{
    use HasFactory;
    public function docente(){
        return $this->belongsTo(Docente::class,'id');
    }

    public function acta(){
        return $this->belongsTo(Acta::class,'id');
    }
}
