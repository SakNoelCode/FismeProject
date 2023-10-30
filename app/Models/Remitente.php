<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remitente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function expedientes(){
        return $this->hasMany(Expediente::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
