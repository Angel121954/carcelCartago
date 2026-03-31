<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitaRequest extends FormRequest
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
            'prisionero_id' => 'required',
            'visitante_id' => 'required',

            // SOLO domingos
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (date('w', strtotime($value)) != 0) {
                        $fail('Las visitas solo se permiten los domingos.');
                    }
                }
            ],

            //  hora inicio
            'hora_inicio' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value < '14:00' || $value > '17:00') {
                        $fail('La hora debe estar entre 14:00 y 17:00.');
                    }
                }
            ],

            //  hora fin
            'hora_fin' => [
                'required',
                'after:hora_inicio',
                function ($attribute, $value, $fail) {
                    if ($value < '14:00' || $value > '17:00') {
                        $fail('La hora debe estar entre 14:00 y 17:00.');
                    }
                }
            ],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $existe = \App\Models\Visita::where('prisionero_id', $this->prisionero_id)
                ->where('fecha', $this->fecha)
                ->where('hora_inicio', $this->hora_inicio)
                ->exists();

            if ($existe) {
                $validator->errors()->add('hora_inicio', 'Este prisionero ya tiene una visita en ese horario.');
            }
        });
    }
}
