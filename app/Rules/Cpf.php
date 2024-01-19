<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = preg_replace("/\D+/", "", $value);

        $digitsPattern = '/\d{11}/';
        $repeatPattern = '/(\d)\1{10}/';

        if(!preg_match($digitsPattern, $value) || preg_match($repeatPattern, $value) || strlen($value) > 11 ){
            $fail('O cpf não é valido');
        }
        $body = substr($value, 0, 9);

        // Dígitos verificadores
        for($pass=0; $pass<2; $pass++){
            $result = 0;
            for($i=0; $i<strlen($body); $i++){
                $result += $body[$i] * (10+$pass-$i);
            }
            $rest = $result % 11 ? 11 - ($result % 11) : 0;
            $body .= $rest === 10 ? 0 : $rest;
        }

        if(!($body === $value)) $fail('O cpf não é valido');
        
    }
}
