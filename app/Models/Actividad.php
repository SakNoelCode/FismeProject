<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = ['name','fecha_inicio','fecha_fin','estado','is_entregable'];

    public function proyecto(){
        return $this->belongsTo(Proyecto::class);
    }
}
