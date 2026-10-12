<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListaResource extends JsonResource
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

            // Cantidad de tareas asociadas si se cargó con withCount('tareas')
            'total_tareas' => $this->whenCounted('tareas'),

            // Incluye las tareas solo si se hizo Lista::with('tareas')
            'tareas' => TareaResource::collection($this->whenLoaded('tareas')),

            'creado_en' => $this->created_at?->toIso8601String(),
            'actualizado_en' => $this->updated_at?->toIso8601String(),
        ];
    }
}
