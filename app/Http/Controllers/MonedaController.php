<?php

namespace App\Http\Controllers;

use App\Models\Moneda;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Moneda::all();
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
                'nombre.required' => 'El nombre de la moneda es obligatorio.',
                'nombre.unique' => 'La moneda ya existe.'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
        }

        $moneda = new Moneda();
        $moneda->nombre = $request->nombre;
        $moneda->simbolo = $request->simbolo;
        $moneda->estado = 'activo';
        $moneda->save();
        return response()->json(['mensaje' => 'Moneda creada con exito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Moneda::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $moneda = Moneda::find($id);
        if ($moneda) {
            try {
                $request->validate([
                    'nombre' => 'unique:monedas,nombre,' . $moneda->id
                ], [
                    'nombre.unique' => 'La moneda ya existe.'
                ]);
            } catch (ValidationException $e) {
                return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
            }

            if ($request->has('nombre')) {
                $moneda->nombre = $request->nombre;
            }
            if ($request->has('simbolo')) {
                $moneda->simbolo = $request->simbolo;
            }
            if ($request->has('estado')) {
                $moneda->estado = $request->estado;
            }

            $moneda->save();
            return response()->json(['mensaje' => 'moneda actualizada con exito'], 200);
        } else {
            return response()->json(['mensaje' => 'moneda no encontrada'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $moneda = Moneda::find($id);
        if (is_null($moneda)) {
            return response()->json(['mensaje' => 'Moneda no encontrada'], 404);
        }
        $moneda->delete();
        return response()->json(['mensaje' => 'Moneda eliminado con exito'], 200);
    }
}
