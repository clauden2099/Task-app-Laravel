<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TareaResource extends JsonResource
{
    /**
     * Formatea los datos del modelo a un formato
     * JSON más apropiado para el frontend
     * También laravel automáticamente envuelve
     * el resultado dentro de una clave "data"
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'detalles' => $this->detalles,

            // Fechas en formato estándar ISO o 'Y-m-d'
            'fecha_limite' => $this->fecha_limite?->format('Y-m-d'),
            'recordatorio' => $this->recordatorio?->toIso8601String(),

            // Campos de estado
            'destacada' => $this->destacada,
            'completada' => $this->completada,

            // Atributo calculado útil para el frontend:
            'esta_vencida' => $this->fecha_limite ? $this->fecha_limite->isPast() && ! $this->completada : false,

            'lista_id' => $this->lista_id,

            // whenLoaded solo incluye la lista SI se cargó en la consulta: Lista::with(...)
            // Si no se cargó, la clave 'lista' ni siquiera aparecerá, ahorrando bytes.
            'lista' => new ListaResource($this->whenLoaded('lista')),

            'creado_en' => $this->created_at?->toIso8601String(),
            'actualizado_en' => $this->updated_at?->toIso8601String(),
        ];
    }
}
