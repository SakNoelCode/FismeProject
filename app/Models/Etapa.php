<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etapa extends Model
{
    use HasFactory;

    public function proyectos(){
        return $this->HasMany(Proyecto::class);
    }
}
