<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Cliente::all();
    }

    /**
     * Guardar clientes
     */
    public function store(Request $request)
    {

        //Validamos los campos que vienen
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required'
        ]);

        //Creamos un nuevo cliente con los datos del request
        $cliente = new Cliente();
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;


        $cliente->save();
        return $cliente;
    }

    /**
     * mosstrar informacion de un solo cliente
     */
    public function show(string $id)
    {
        return Cliente::find($id);
    }
    // public function show(Cliente $cliente)
    // {
    //     return $cliente;
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $cliente = Cliente::find($id);
        if ($request->has('nombres')) {
            $cliente->nombres = $request->nombres;
        }

        if ($request->has('apellidos')) {
            $cliente->apellidos = $request->apellidos;
        }

        $cliente->save();
        
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $cliente = Cliente::find($id);
        if (is_null($cliente)) {
            return response()->json(['mensaje' => 'Cliente no encontrado'], 404);
        } else {
            $cliente->delete();
            return [$cliente, 'Cliente eliminado'];
        }
    }
}
