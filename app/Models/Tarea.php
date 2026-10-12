<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tarea'; // nombre de la tabla

    protected $fillable = [
        'nombre',
        'detalles',
        'fecha_limite',
        'recordatorio',
        'destacada',
        'completada',
        'lista_id',
    ];

    /**
     * Con el método casts le indicamos a Laravel que tipo de dato tiene cada columna
     * Así nos evitamos estar haciendo la conversión manualmente cada vez que obtenemos los datos
     * De esta manera ayuda de forma interna a la aplicación sobre como tratar e interactuar con
     * los datos del modelo en diferentes partes de la aplicación
     */
    protected function casts(): array
    {
        return [
            'destacada' => 'boolean',
            'completada' => 'boolean',
            'fecha_limite' => 'date',
            'recordatorio' => 'datetime',
        ];
    }

    // Indica que esta entidad contiene otra entidad
    // Osea que una tarea pertenece a una lista
    public function lista()
    {
        return $this->belongsTo(Lista::class, 'lista_id');
    }
}
