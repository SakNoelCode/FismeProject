<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
    public function asesor(): BelongsTo
    {
        return $this->belongsTo(Asesor::class);
    }
    public function tesista(): BelongsTo
    {
        return $this->belongsTo(Tesista::class);
    }
    public function expedientes(): HasMany
    {
        return $this->hasMany(Expediente::class);
    }
    public function actividades(): HasMany
    {
        return $this->hasMany(Actividad::class);
    }
    public function resoluciones(): HasMany
    {
        return $this->hasMany(Resolucion::class);
    }

    public function etapa(): BelongsTo
    {
        return $this->belongsTo(Etapa::class);
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }

    public function juradotesis(): BelongsTo
    {
        return $this->belongsTo(Juradotesi::class, 'juradotesi_id');
    }
}
