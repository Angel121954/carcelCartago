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
        // En edición no se requieren email/password
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'nombre_completo'       => 'required|string|max:255',
                'numero_identificacion' => 'required|string|max:50',
                'activo'                => 'nullable|boolean',
            ];
        }

        return [
            'nombre_completo'       => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'       => 'Ya existe un usuario con ese correo.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}
