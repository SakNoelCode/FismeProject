<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeAsesorRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'especialidad' => 'required|max:100',
            'escuela_id' => 'required|integer|exists:escuelas,id',
            'password'  => 'required|same:password_confirm|min:6|different:email'
        ];
    }
}
