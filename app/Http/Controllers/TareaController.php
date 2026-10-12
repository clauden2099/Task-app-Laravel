<?php

namespace App\Http\Controllers;

use App\Http\Requests\TareaRequest;
use App\Http\Resources\TareaResource;
use App\Models\Lista;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function index(Lista $lista)
    {
        $tareas = Tarea::where('lista_id', '=', $lista->id)->get();

        return TareaResource::collection($tareas);
    }

    public function getDestacadas()
    {
        $tareas = Tarea::where('destacada', true)->get();

        return TareaResource::collection($tareas);
    }

    public function show(Tarea $tarea)
    {
        return new TareaResource($tarea);
    }

    public function store(TareaRequest $request)
    {

        /**
         *  Ejecuta la validaciones del formRequest de tarea
         * el método validated() regresa los campos qué están definidos
         * en el método rules() y que hayan pasado la validación
         */
        $validateData = $request->validated();

        $tarea = Tarea::create($validateData);

        return (new TareaResource($tarea))
            ->response()
            ->setStatusCode(201);
    }

    public function update(TareaRequest $request, Tarea $tarea)
    {
        $validateData = $request->validated();
        $tarea->update($validateData);

        return (new TareaResource($tarea))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->json([
            'message' => 'Tarea eliminada exitosamente',
        ]);
    }
}
