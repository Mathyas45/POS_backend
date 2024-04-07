<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateMarcaRequest;
use Illuminate\Validation\ValidationException;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Marca::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|unique:marcas'
            ], [
                'nombre.required' => 'El nombre de la marca es obligatorio.',
                'nombre.unique' => 'La marca ya existe.'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()->first(), 'status' => 400], 400);
        }

        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->save();
        return response()->json(['mensaje' => 'Marca creada con exito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Marca::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $marca = Marca::find($id);
        if ($marca) {
            try {
                $request->validate([
                    'nombre' => 'unique:marcas,nombre,' . $marca->id
                ], [
                    'nombre.unique' => 'La marca ya existe.'
                ]);
            } catch (ValidationException $e) {
                return response()->json(['message' => $e->validator->errors()->first(), 'status' => 400], 400);
            }

            if ($request->has('nombre')) {
                $marca->nombre = $request->nombre;
            }
            if ($request->has('descripcion')) {
                $marca->descripcion = $request->descripcion;
            }
            $marca->save();
            return response()->json(['mensaje' => 'Marca actualizada con exito'], 200);
        } else {
            return response()->json(['mensaje' => 'Marca no encontrada'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $marca = Marca::find($id);
        if ($marca) {
            $marca->delete();
            return response()->json(['mensaje' => 'Marca eliminada con exito'], 200);
        } else {
            return response()->json(['mensaje' => 'Marca no encontrada'], 404);
        }
    }
}
