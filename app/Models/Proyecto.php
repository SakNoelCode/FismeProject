<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function empresa()
    {
        return $this->belongsToMany(Empresa::class);
    }
    public function asesor()
    {
        return $this->belongsToMany(Asesor::class);
    }
    public function tesista()
    {
        return $this->belongsTo(Tesista::class);
    }
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }
    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
    public function resoluciones()
    {
        return $this->hasMany(Resolucion::class);
    }
}
