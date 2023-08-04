<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesista extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'escuela_id',
        'user_id',
    ];

    public function escuela(){
        return $this->belongsTo(Escuela::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function proyecto(){
        return $this->hasOne(Proyecto::class);
    }
}
