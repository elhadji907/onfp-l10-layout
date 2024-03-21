<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArriveStoreRequest extends FormRequest
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
            "date_arrivee"          => ["required", "date"],
            "date_correspondance"   => ["required", "date"],
            "numero_correspondance" => ["required", "string", "min:4", "max:6", "unique:arrives,numero,Null,id,deleted_at,NULL"],
            "annee"                 => ["required", "string"],
            "expediteur"            => ["required", "string"],
            "objet"                 => ["required", "string"],
        ];
    }
}
