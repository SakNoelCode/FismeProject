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

    public function asesores()
    {
        return $this->belongsToMany(
            Asesor::class,
            'asesore_comision',
            'comision_id',
            'asesore_id',
            'id',
            'id'
        )
            ->withTimestamps()->withPivot('cargo','asesore_id');
    }
}
