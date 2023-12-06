<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DiferentesValoresJuradoProyectoRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($attribute == 'presidente') {

            // Obtén los valores de los otros campos
            $secretario = request()->input('secretario');
            $vocal = request()->input('vocal');
            $accesitario = request()->input('accesitario');


            // Verifica que todos los valores sean diferentes
            if ($value == $secretario || $value == $vocal || $value == $accesitario) {
                $fail('No puede repetir el mismo docente.');
            }
        }

        if ($attribute == 'secretario') {

            // Obtén los valores de los otros campos
            $presidente = request()->input('presidente');
            $vocal = request()->input('vocal');
            $accesitario = request()->input('accesitario');


            // Verifica que todos los valores sean diferentes
            if ($value == $presidente || $value == $vocal || $value == $accesitario) {
                $fail('No puede repetir el mismo docente.');
            }
        }

        if ($attribute == 'vocal') {

            // Obtén los valores de los otros campos
            $secretario = request()->input('secretario');
            $presidente = request()->input('presidente');
            $accesitario = request()->input('accesitario');


            // Verifica que todos los valores sean diferentes
            if ($value == $secretario || $value == $presidente || $value == $accesitario) {
                $fail('No puede repetir el mismo docente.');
            }
        }

        if ($attribute == 'accesitario') {

            // Obtén los valores de los otros campos
            $secretario = request()->input('secretario');
            $vocal = request()->input('vocal');
            $presidente = request()->input('presidente');


            // Verifica que todos los valores sean diferentes
            if ($value == $secretario || $value == $vocal || $value == $presidente) {
                $fail('No puede repetir el mismo docente.');
            }
        }
    }
}
