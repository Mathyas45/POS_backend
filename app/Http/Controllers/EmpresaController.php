<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Empty_;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Empresa::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|unique:empresas',
                'direccion'  => 'required',
                'ruc' => 'required|unique:empresas'
            ], [
                'nombre.required' => 'El nombre de la Empresa es obligatorio.',
                'direccion.required' => 'La dirección de la empresa es obligatoria.',
                'nombre.unique' => 'La Empresa ya existe.',
                'ruc.required' => 'El RUC de la Empresa es obligatorio.',

            ]);
        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->validator->errors()->first(), 'status' => 400], 400);
        }

        $empresa = new Empresa();
        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->email = $request->email;
        $empresa->ruc = $request->ruc;
        $empresa->save();
        return response()->json(['mensaje' => 'Empresa creada con exito'], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Empresa::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $empresa = Empresa::find($id);
        $request->validate([
        'nombre' => 'unique:empresas,nombre' . $empresa->id,
    ]);

        if ($request->has('nombre')) {
            $empresa->nombre = $request->nombre;
        }
        if ($request->has('direccion')) {
            $empresa->direccion = $request->direccion;
        }
        if ($request->has('telefono')) {
            $empresa->telefono = $request->telefono;
        }
        if ($request->has('email')) {
            $empresa->email = $request->email;
        }
        if ($request->has('ruc')) {
            $empresa->ruc = $request->ruc;
        }

        $empresa->save();
        return response()->json(['mensaje' => 'Empresa actualizada con exito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        if (is_null($empresa)) {
            return response()->json(['mensaje' => 'Empresa no encontrada'], 404);
        }
        $empresa->delete();
        return response()->json(['mensaje' => 'Empresa eliminada con exito'], 200);
    }
}
