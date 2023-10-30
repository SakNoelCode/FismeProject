<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_path','expediente_id'];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    /**
     * Función para guardar un documento en el storage
     */
    public function guardarDocumento($file)
    {
        $uploadedFile = $file;
        $uniqueFileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs('documentos', $uniqueFileName);

        return $uniqueFileName;
    }
}
