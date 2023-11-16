<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comision extends Model
{
    protected $table = 'comisiones';
    protected $guarded = ['id'];

    use HasFactory;

    public function asesores(): HasMany
    {
        return $this->hasMany(Asesor::class);
    }
}
