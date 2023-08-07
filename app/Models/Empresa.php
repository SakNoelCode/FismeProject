<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function proyectos(){
        return $this->hasMany(Proyecto::class);
    }
}
