<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'civilite' => ['required', 'string', 'max:8'],
            'firstname' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:25'],
            'date_naissance' => ['string', 'required'],
            'lieu_naissance' => ['string', 'required'],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'telephone' => ['required', 'string', 'max:25', 'min:9'],
            'adresse' => ['required', 'string', 'max:255'],
            'situation_familiale' => ['string', 'max:15', 'required'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
        ];
    }
}
