<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TareaRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Verifica si la petición es put o patch
        $esActualizacion = $this->isMethod('put') || $this->isMethod('patch');

        // Verificación del tipo de petición
        return [
            'nombre' => [$esActualizacion ? 'sometimes' : 'required', 'string', 'max:255'],
            // Indica que el id de la lista debe de existir
            // en la tabla lista -> exist:(tabla,columna)
            'lista_id' => [$esActualizacion ? 'sometimes' : 'required', 'integer', 'exists:lista,id'],
            'detalles' => 'nullable|string',
            // Indica que debe ser una fecha
            'fecha_limite' => 'date|nullable',
            'recordatorio' => 'date|nullable',
            'destacada' => 'boolean',
            'completada' => 'boolean',
        ];
    }
}
