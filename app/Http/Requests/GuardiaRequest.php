<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_completo'       => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50',
            'activo'                => 'nullable|boolean',
        ];
    }
}
