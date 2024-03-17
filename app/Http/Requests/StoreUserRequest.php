<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected $id;

    /* Cette fonction nous permet de récupérer l'id de l'utilisateur qu'on et entrain de modifier */
    public function __construct(Request $request)
    {
        $this->id = (integer) $request->route()->user;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:25'],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'email' => ['sometimes', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)->whereNull('deleted_at')],
            'telephone' => ['required', 'string', 'max:25', 'min:9'],
            'adresse' => ['required', 'string', 'max:255'],
        ];
    }
}
