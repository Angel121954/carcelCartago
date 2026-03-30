<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VisitanteRequest extends FormRequest
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
     */
    public function rules(): array
    {
        // En update, se ignora el registro actual para no chocar con su propio número
        $visitanteId = $this->route('visitante')?->id ?? $this->route('visitante');

        return [
            'nombre_completo'       => 'required|string|max:255',
            'numero_identificacion' => [
                'required',
                'string',
                'max:50',
                Rule::unique('visitantes', 'numero_identificacion')->ignore($visitanteId),
            ],
            'relacion'              => 'required|string|max:100',
        ];
    }

    /**
     * Custom validation messages in Spanish.
     */
    public function messages(): array
    {
        return [
            'nombre_completo.required'       => 'El nombre completo es obligatorio.',
            'nombre_completo.max'            => 'El nombre no puede superar 255 caracteres.',
            'numero_identificacion.required' => 'El número de identificación es obligatorio.',
            'numero_identificacion.unique'   => 'Este número de identificación ya está registrado en el sistema.',
            'numero_identificacion.max'      => 'El número de identificación no puede superar 50 caracteres.',
            'relacion.required'              => 'La relación con el prisionero es obligatoria.',
            'relacion.max'                   => 'La relación no puede superar 100 caracteres.',
        ];
    }
}
