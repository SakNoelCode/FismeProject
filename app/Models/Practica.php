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


    public function practicante(): HasOne
    {
        return $this->hasOne(Practicante::class);
    }

    public function actas(): HasMany
    {
        return $this->hasMany(Acta::class);
    }

    public function guardarDocumento($file)
    {
        $uploadedFile = $file;
        $uniqueFileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs('informes', $uniqueFileName);
        return $uniqueFileName;
    }

    public function guardarActaRevision($file)
    {
        $uploadedFile = $file;
        $uniqueFileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs('actas', $uniqueFileName);
        return 'actas/' . $uniqueFileName;
    }

    public function guardarActaSustentacion($file)
    {
        $uploadedFile = $file;
        $uniqueFileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs('actas', $uniqueFileName);
        return $uniqueFileName;
    }
}
