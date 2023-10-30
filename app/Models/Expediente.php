<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = ['numeracion','tipo','asunto','remitente_id','tipo_documento','area_id'];

    //Crear numeración de manera automática
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expediente) {
            $ultimoNumero = Documento::max('id');
            $expediente->numeracion = sprintf('%05d', $ultimoNumero);
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
}
