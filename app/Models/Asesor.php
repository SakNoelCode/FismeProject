<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    use HasFactory;

    protected $table = 'asesores';

    protected $fillable = ['especialidad', 'escuela_id', 'user_id', 'comision_id'];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
    public function comision()
    {
        return $this->belongsToMany(Comision::class, 'asesore_comision', 'asesore_id', 'comision_id', 'id', 'id')->withTimestamps()->withPivot('cargo');
    }
    public function practicantes()
    {
        return $this->hasMany(Practicante::class, 'asesore_id');
    }
}
