<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Remitente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function expedientes(): MorphMany
    {
        return $this->morphMany(Expediente::class, 'expedientable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
