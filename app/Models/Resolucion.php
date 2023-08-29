<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    use HasFactory;

    protected $fillable = ['tipo','resolucion_path','descripcion','proyecto_id'];

    protected $table = 'resoluciones';

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
