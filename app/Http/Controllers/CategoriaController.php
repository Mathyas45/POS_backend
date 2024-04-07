<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Categoria::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'nombre' => 'required|unique:categorias'
            ], [
                'nombre.required' => 'El nombre de la categoría es obligatorio.',
                'nombre.unique' => 'La categoría ya existe.'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()->first(), 'status' => 400], 400);
        }

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return response()->json(['mensaje' => 'Categoria creada con exito'], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        return Categoria::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $categoria = Categoria::find($id);
        if ($request->has('nombre')) {
            $categoria->nombre = $request->nombre;
        }
        if ($request->has('descripcion')) {
            $categoria->descripcion = $request->descripcion;
        }
        $categoria->save();
        return response()->json(['mensaje' => 'Categoria actualizada con exito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {

        $categoria = Categoria::find($id);
        if (is_null($categoria)) {
            return response()->json(['mensaje' => 'Categoria no encontrada'], 404);
        }
        $categoria->delete();
        return response()->json(['mensaje' => 'Categoria eliminada con exito'], 200);
    }
}
