<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComisionRequest extends FormRequest
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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'presidente' => 'required|numeric|different:secretario,vocal,accesitario',
            'secretario' => 'required|numeric|different:presidente,vocal,accesitario',
            'vocal' => 'required|numeric|different:presidente,secretario,accesitario',
            'accesitario' => 'required|numeric|different:presidente,secretario,vocal'
        ];
    }
}
