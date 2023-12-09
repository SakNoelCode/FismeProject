<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = ['numeracion', 'tipo', 'asunto', 'remitente_id', 'tipodocumento_id', 'area_id', 'estado'];

    //Crear numeración de manera automática
    protected static function boot()
    {
        parent::boot();

        /*
        static::creating(function ($expediente) {
            $ultimoNumeroDocumento = Documento::count();
            $ultimoNumeroPractica = Practica::count();

            if ($ultimoNumeroDocumento == 0 && $ultimoNumeroPractica == 0) {
                $expediente->numeracion = sprintf('%05d', 1);
            } else {
                $numeroMayor = max([$ultimoNumeroDocumento, $ultimoNumeroPractica]);
                $expediente->numeracion = sprintf('%05d', $numeroMayor + 1);
            }
        });*/

        // Agregar un evento creating para generar la numeración automática
        static::creating(function ($model) {
            //$ultimoNumero = static::max('id'); // Obtener el último número en la tabla
            $ultimoRegistroPractica = Practica::latest()->first();
            $ultimoNumeroPractica = $ultimoRegistroPractica ? (int) $ultimoRegistroPractica->numeracion : null;

            $ultimoRegistroExpediente = Expediente::latest()->first();
            $ultimoNumeroExpediente = $ultimoRegistroExpediente ? (int) $ultimoRegistroExpediente->numeracion : null;

            $ultimoNumero = max($ultimoNumeroExpediente, $ultimoNumeroPractica);

            // Si no hay registros, establecer el número inicial
            $nuevoNumero = $ultimoNumero ? $ultimoNumero + 1 : 1;

            // Formatear el número con ceros a la izquierda
            $model->numeracion = sprintf('%05d', $nuevoNumero);
        });
    }

    /*
    public function remitente()
    {
        return $this->belongsTo(Remitente::class);
    }*/
    public function expedientable(): MorphTo
    {
        return $this->morphTo();
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }

    public function historiales(): HasMany
    {
        return $this->hasMany(Historiale::class);
    }

    public function proveidos(): HasMany
    {
        return $this->hasMany(Proveido::class);
    }

    public function tipodocumento(): BelongsTo
    {
        return $this->belongsTo(Tipodocumento::class);
    }
}
