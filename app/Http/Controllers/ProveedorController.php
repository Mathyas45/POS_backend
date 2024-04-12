<?php

namespace App\Http\Controllers;

use App\Models\proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return proveedor::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|unique:proveedores',
                'num_documento' => 'required|unique:proveedores'
            ], [
                'nombre.required' => 'El nombre del proveedor es obligatorio.',
                'nombre.unique' => 'El proveedor ya existe.',
                'num_documento' => 'El numero de documento del proveedor es obligatorio.',
                'num_documento.unique' => 'El numero de documento del proveedor ya existe.',

            ]);
        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
        }

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->tipo_documento = $request->tipo_documento;
        $proveedor->num_documento = $request->num_documento;
        $proveedor->estado = 'activo';

        $proveedor->save();
        return response()->json(['mensaje' => 'Proveedor creado con exito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return proveedor::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {

        $proveedor = Proveedor::find($id);
        try {
            if (!$proveedor) {
                return response()->json(['mensaje' => 'Proveedor no encontrada'], 404);
            }

            $request->validate([
                'nombre' => 'unique:proveedores,nombre,' . $proveedor->id,
                'num_documento' => 'unique:proveedores,num_documento,' . $proveedor->id,
            ], [
                'nombre.unique' => 'El nombre del proveedor ya existe.',
                'num_documento.unique' => 'El numero de documento del proveedor ya existe.',
            ]);

        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
        }


        if ($request->has('nombre')) {
            $proveedor->nombre = $request->nombre;
        }
        if ($request->has('direccion')) {
            $proveedor->direccion = $request->direccion;
        }
        if ($request->has('telefono')) {
            $proveedor->telefono = $request->telefono;
        }
        if ($request->has('email')) {
            $proveedor->email = $request->email;
        }
        if ($request->has('tipo_documento')) {
            $proveedor->tipo_documento = $request->tipo_documento;
        }
        if ($request->has('num_documento')) {
            $proveedor->num_documento = $request->num_documento;
        }
        if ($request->has('estado')) {
            $proveedor->estado = $request->estado;
        }

        $proveedor->save();
        return response()->json(['mensaje' => 'Proveedor actualizado con exito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = proveedor::find($id);
        if (is_null($proveedor)) {
            return response()->json(['mensaje' => 'proveedor no encontrada'], 404);
        }
        $proveedor->delete();
        return response()->json(['mensaje' => 'Proveedor eliminado con exito'], 200);
    }
}
