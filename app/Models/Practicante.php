<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Practicante extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function escuela():BelongsTo
    {
        return $this->belongsTo(Escuela::class);
    }

    public function asesore(){
        return $this->belongsTo(Asesor::class,'asesore_id');
    }

    public function practica(){
        return $this->belongsTo(Practica::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
