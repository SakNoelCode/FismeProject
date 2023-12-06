<?php

namespace App\Http\Requests;

use App\Rules\DiferentesValoresJuradoProyectoRule;
use Illuminate\Foundation\Http\FormRequest;

class saveAsignarJuradoRequest extends FormRequest
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
            'presidente' => ['required', new DiferentesValoresJuradoProyectoRule],
            'secretario' => ['required', new DiferentesValoresJuradoProyectoRule],
            'vocal' => ['required', new DiferentesValoresJuradoProyectoRule],
            'accesitario' => ['required', new DiferentesValoresJuradoProyectoRule]
        ];
    }
}
