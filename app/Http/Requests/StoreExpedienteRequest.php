<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpedienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'razon_social' => 'required|max:100',
            'numero_documento' => 'required|max:45',
            'email' => 'required|email|max:255',
            'tipo' => 'required|max:50',
            'descripcion' => 'required|max:250',
            'nombre_path' => 'required|file|mimes:pdf,doc,docx'
        ];
    }
}
