<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitanteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // En edición ignorar el propio registro
        $ignore = '';
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $ignore = ',' . $this->route('visitante')?->id;
        }

        return [
            'nombre_completo'       => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50|unique:visitantes,numero_identificacion' . $ignore,
            'relacion'              => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'numero_identificacion.unique' => '¡Alerta! Este visitante ya está registrado en el sistema (número de identificación duplicado).',
        ];
    }
}
