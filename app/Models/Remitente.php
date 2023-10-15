<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remitente extends Model
{
    use HasFactory;

    protected $fillable = ['razon_social','numero_documento','email'];

    public function expedientes(){
        return $this->hasMany(Expediente::class);
    }
}
