<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = ['numeracion', 'tipo', 'asunto', 'remitente_id', 'tipo_documento', 'area_id'];

    //Crear numeración de manera automática
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expediente) {
            $ultimoNumeroDocumento = Documento::count();
            $ultimoNumeroPractica = Practica::count();

            if ($ultimoNumeroDocumento == 0 && $ultimoNumeroPractica == 0) {
                $expediente->numeracion = sprintf('%05d', 1);
            } else {
                $numeroMayor = max([$ultimoNumeroDocumento, $ultimoNumeroPractica]);
                $expediente->numeracion = sprintf('%05d', $numeroMayor + 1);
            }
        });
    }

    public function remitente()
    {
        return $this->belongsTo(Remitente::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function historiales()
    {
        return $this->hasMany(Historiale::class);
    }

    public function proveidos(): HasMany
    {
        return $this->hasMany(Proveido::class);
    }
}
