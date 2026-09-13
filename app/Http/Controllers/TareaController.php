<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index(Lista $lista)
    {
        $tareas = Tarea::where('lista_id', '=', $lista->id)->get();
        return response()->json($tareas);
    }

    public function getDestacadas(){
        $tareas = Tarea::where('destacada',true)->get();

        return response()->json($tareas);
    }
    
    public function show(Tarea $tarea){
        return response()->json($tarea);
    }

    public function store(Request $request)
    {
        $tarea = Tarea::create($request->all());

        return response()->json($tarea);
    }

    public function update(Request $request, Tarea $tarea)
    {
        $tarea->update($request->all());

        return response()->json(['message' => 'Producto actualizado']);
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->json([
            'message' => 'Tarea eliminada exitosamente'
        ]);
    }
}
