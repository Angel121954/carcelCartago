<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrisioneroRequest extends FormRequest
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
			'nombre_completo' => 'required|string',
			'fecha_nacimiento' => 'required',
			'fecha_ingreso' => 'required',
			'delito' => 'required|string',
			'celda' => 'required|string',
        ];
    }
}
