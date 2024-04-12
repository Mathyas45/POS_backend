<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Http\Requests\StoreUnidadRequest;
use App\Http\Requests\UpdateUnidadRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Unidad::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|unique:unidades'
            ], [
                'nombre.required' => 'El nombre del estado es obligatorio.',
                'nombre.unique' => 'El estado ya existe.'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()->first(), 'status' => 400], 400);
        }
        $unidad = new Unidad();
        $unidad->nombre = $request->nombre;
        $unidad->estado = 'activo';
        $unidad->save();
        return response()->json(['mensaje' => 'Estado creado con exito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Unidad::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $unidad = Unidad::find($id);
        try {
            if (!$unidad) {
                return response()->json(['mensaje' => 'Unidad no encontrada'], 404);
            }

            $request->validate([
                'nombre' => 'unique:unidades,nombre,' . $unidad->id,
            ], [
                'nombre.unique' => 'El nombre de la unidad ya existe.'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
        }

        if ($request->has('nombre')) {
            $unidad->nombre = $request->nombre;
        }
        if ($request->has('estado')) {
            $unidad->estado = $request->estado;
        }

        $unidad->save();

        return response()->json(['mensaje' => 'Unidad actualizada con éxito'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $unidad = Unidad::find($id);
        $unidad->delete();
        return response()->json(['mensaje' => 'Unidad de medida eliminado con exito'], 200);
    }
}
