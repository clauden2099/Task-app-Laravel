<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;
    
    protected $table = "lista";

    protected $fillable = ['nombre'];

    //Indica que esta entidad esta en muchas otras
    //osea que una lista tiene muchas tareas
    public function tareas(){
        return $this->hasMany(Tarea::class);
    }
}
