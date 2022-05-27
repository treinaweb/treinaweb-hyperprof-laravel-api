<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $emailValidation = ['required','string','email','max:255','unique:users,email'];

        if (Auth::check()) {
            $emailValidation[4] .= ',' . Auth::user()->id;
        }

        return [
            'nome' => ['required','string','max:255'],
            'idade' => ['required','integer'],
            'valor_aula' => ['required','numeric'],
            'descricao' => ['required','string','max:500'],

            'email' => $emailValidation,
            'password' => ['required','string','min:6','confirmed'],
        ];
    }
}
