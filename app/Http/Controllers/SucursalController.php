<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Sucursal::with(['empresa:id,nombre'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|unique:sucursales',
                'direccion'  => 'required',
            ], [
                'nombre.required' => 'El nombre de la Sucursal es obligatorio.',
                'direccion.required' => 'La dirección de la Sucursal es obligatoria.',
                'nombre.unique' => 'La Sucursal ya existe.'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
        }

        $sucursal = new Sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->email = $request->email;
        $sucursal->estado = 'activo';
        $sucursal->responsable = $request->responsable;
        $sucursal->empresa_id = $request->empresa_id;
        $sucursal->save();
        return response()->json(['mensaje' => 'Sucursal creada con exito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Sucursal::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $sucursal = Sucursal::find($id);
        try {
            if (!$sucursal) {
                return response()->json(['mensaje' => 'Sucursal no encontrada'], 404);
            }
            $request->validate([
                'nombre' => 'unique:sucursales,nombre,' . $sucursal->id,
            ], [
                'nombre.unique' => 'El nombre de la sucursal ya existe.'
            ]);

        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
        }


        if ($request->has('nombre')) {
            $sucursal->nombre = $request->nombre;
        }
        if ($request->has('direccion')) {
            $sucursal->direccion = $request->direccion;
        }
        if ($request->has('telefono')) {
            $sucursal->telefono = $request->telefono;
        }
        if ($request->has('email')) {
            $sucursal->email = $request->email;
        }
        if ($request->has('estado')) {
            $sucursal->estado = $request->estado;
        }
        if ($request->has('responsable')) {
            $sucursal->responsable = $request->responsable;
        }
        if ($request->has('empresa_id')) {
            $sucursal->empresa_id = $request->empresa_id;
        }

        $sucursal->save();
        return response()->json(['mensaje' => 'Sucursal actualizada con exito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::find($id);
        if (is_null($sucursal)) {
            return response()->json(['mensaje' => 'Sucursal no encontrada'], 404);
        }
        $sucursal->delete();
        return response()->json(['mensaje' => 'Sucursal eliminada con exito'], 200);
    }
}
