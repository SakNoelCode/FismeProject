<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Practica extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    //Crear numeración de manera automática
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($practica) {
            $ultimoNumeroDocumento = Documento::count();
            $ultimoNumeroPractica = Practica::count();

            if ($ultimoNumeroDocumento == 0 && $ultimoNumeroPractica == 0) {
                $practica->numeracion = sprintf('%05d', 1);
            } else {
                $numeroMayor = max([$ultimoNumeroDocumento,$ultimoNumeroPractica]);
                $practica->numeracion = sprintf('%05d', $numeroMayor + 1);
            }
        });
    }


    public function practicante(): HasOne
    {
        return $this->hasOne(Practica::class);
    }

    public function actas(): HasMany
    {
        return $this->hasMany(Acta::class);
    }
}
