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

    public function practicante(): HasOne
    {
        return $this->hasOne(Practica::class);
    }

    public function actas(): HasMany
    {
        return $this->hasMany(Acta::class);
    }
}
