<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Secretaria extends Model
{
    use HasFactory;

    protected $fillable = ['cargo', 'escuela_id', 'user_id', 'area_id'];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function expedientes(): MorphMany
    {
        return $this->morphMany(Expediente::class, 'expedientable');
    }
}
