<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    public function remitente(){
        return $this->belongsTo(Remitente::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function documento(){
        return $this->belongsTo(Documento::class);
    }

    public function historiales(){
        return $this->hasMany(Historiale::class);
    }
}
