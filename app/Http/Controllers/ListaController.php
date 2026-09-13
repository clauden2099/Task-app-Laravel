<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Tarea;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function index()
    {
        $listas = Lista::all();

        return response()->json($listas);
    }
    public function store(Request $request)
    {

        $lista = Lista::create($request->all());

        return response()->json($lista);
    }

    public function update(Request $request, Lista $lista){
        $lista->update($request->all());
        return response()->json(['message' => 'Producto actualizado']);
    }

    public function destroy(Lista $lista)
    {
        $lista->delete();

        return response()->json([
            'message' => 'Lista eliminada exitosamente'
        ]);
    }
}
