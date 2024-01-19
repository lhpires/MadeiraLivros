<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user" => ["required","integer","exists:users,id"],
            "book" => ["required","integer","exists:books,id"],
            "dt_ini" => ["required","after:yesterday"],
            "dt_end" => ["required","after:today",'before:' . now()->addDays(31)],
        ];
    }

    public function messages()
    {      
        return [
            "dt_end.before" => "Aluguel só pode ter até 30 dias",
        ];   
    }

    public function attributes()
    {
        return [
            "dt_ini" => "Data de Inicio do aluguel",
            "dt_end" => "Data de Final do aluguel",
        ];        
    }
}
