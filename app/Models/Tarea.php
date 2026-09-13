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
        'lista_id'
    ];

    //Indica que esta entidad contiene otra entidad
    // Osea que una tarea pertenece a una lista
    public function lista()
    {
        return $this->belongsTo(Lista::class, 'lista_id');
    }
}
