<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipeRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'descricao' => 'required|max:255',
            'selectedItems' => 'required',
        ];
    }
}
