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
            'numero_ordre'    =>  ['required','string','min:4','max:6','unique:departs,numero,Null,id,deleted_at,NULL'],
            'nbre_pieces'     =>  ['required','numeric'],
            'annee'           =>  ['required','numeric','min:2022'],
            'destinataire'    =>  ['required','string','max:100'],
            'objet'           =>  ['required','string','max:200'],
            'numero_archive'  =>  ['required','string','min:4','max:6','unique:courriers,num_bord,Null,id,deleted_at,NULL'],
            'date_depart'     =>  ['required','date'],
        ];
    }
}
