<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListaRequest;
use App\Http\Resources\ListaResource;
use App\Models\Lista;

class ListaController extends Controller
{
    public function index()
    {
        // Carga las listas e incluye el conteo de tareas
        $listas = Lista::withCount('tareas')->get();

        return ListaResource::collection($listas);
    }

    public function show(Lista $lista)
    {
        $lista->loadCount('tareas');

        return new ListaResource($lista);
    }

    public function store(ListaRequest $request)
    {
        // Validación de los campos
        $validateData = $request->validated();
        $lista = Lista::create($validateData);

        return (new ListaResource($lista))
            ->response()
            ->setStatusCode(201);
    }

    public function update(ListaRequest $request, Lista $lista)
    {
        // Validación de los campos
        $validateData = $request->validated();

        $lista->update($validateData);

        return (new ListaResource($lista))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Lista $lista)
    {
        $lista->delete();

        return response()->json([
            'message' => 'Lista eliminada correctamente',
        ], 200);
    }
}
