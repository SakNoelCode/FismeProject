<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proveido extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function expediente(): BelongsTo
    {
        return $this->belongsTo(Proveido::class);
    }
}
