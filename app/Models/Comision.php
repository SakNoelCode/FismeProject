<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = 'comisiones';
    protected $guarded = ['id'];

    use HasFactory;

    public function asesores(){
        return $this->hasMany(Asesor::class);
    }
}
