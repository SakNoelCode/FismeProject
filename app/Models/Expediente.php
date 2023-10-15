<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = ['numeracion','codigo','fecha_recepcion','remitente_id','documento_id','area_id'];

    //Crear numeración de manera automática
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expediente) {
            $ultimoNumero = Documento::max('id');
            if ($ultimoNumero === null) {
                $nuevoNumero = 1;
            } else {
                $nuevoNumero = $ultimoNumero + 1;
            }
            $expediente->numeracion = sprintf('%05d', $nuevoNumero);
        });
    }

    /**
     * Función para generar un código aleatorio de 6 dígitos y único
     * 
     */
    public function generateCodigoSeguridad()
    {
        $codigoSeguridad = strtoupper(str::random(6));
        return $codigoSeguridad;
    }

    /**
     * Función para recuperar solo la fecha actual
     */
    public function generateFecha()
    {
        $fechaActual = Carbon::now();
        $fechaParaBaseDeDatos = $fechaActual->toDateString();
        return $fechaParaBaseDeDatos;
    }

    public function remitente()
    {
        return $this->belongsTo(Remitente::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function historiales()
    {
        return $this->hasMany(Historiale::class);
    }
}
