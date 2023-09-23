<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historiale extends Model
{
    use HasFactory;

    protected $fillable = ['documento_adjunto','fecha_hora','descripcion','user_id'];

    public function expediente(){
        return $this->belongsTo(Expediente::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
