<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return Producto::all(); //select * from productos
        return Producto::with('categoria:id,nombre')->get(); // Carga la relación 'categoria' y selecciona solo el nombre

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'precio' => 'required',

            'stock' => 'required',
            'stock_minimo' => 'required',

            'categoria_id' => 'required'
        ]);

        $nuevoProd = new Producto();
        $nuevoProd->nombre = $request->nombre;
        $nuevoProd->codigo = $request->codigo;
        if ($archivo = $request->file('imagen')) {
            $nombre = $archivo->getClientOriginalName();
            $archivo->move('images', $nombre);
            $nuevoProd->imagen = $nombre;
        } else {
            $nuevoProd->imagen = 'noimage.jpg';
        }
        $nuevoProd->descripcion = $request->descripcion;
        $nuevoProd->precio = $request->precio;
        $nuevoProd->fecha_vencimiento = $request->fecha_vencimiento;
        $nuevoProd->stock = $request->stock;
        $nuevoProd->stock_minimo = $request->stock_minimo;
        $nuevoProd->categoria_id = $request->categoria_id;

        $nuevoProd->save();

        return $nuevoProd;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Producto::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {

        $producto = Producto::find($id);
        if ($request->has('nombre')) {
            $producto->nombre = $request->nombre;
        }
        if ($request->has('codigo')) {
            $producto->codigo = $request->codigo;
        }
        if ($request->has('imagen')) {
            $producto->imagen = $request->imagen;
        }
        if ($request->has('descripcion')) {
            $producto->descripcion = $request->descripcion;
        }
        if ($request->has('precio')) {
            $producto->precio = $request->precio;
        }
        if ($request->has('fecha_vencimiento')) {
            $producto->fecha_vencimiento = $request->fecha_vencimiento;
        }
        if ($request->has('stock')) {
            $producto->stock = $request->stock;
        }
        if ($request->has('stock_minimo')) {
            $producto->stock_minimo = $request->stock_minimo;
        }
        if ($request->has('categoria_id')) {
            $producto->categoria_id = $request->categoria_id;
        }
        $producto->save();
        return response()->json(['mensaje' => 'Producto actualizado con exito'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)

    {
        $producto = Producto::find($id);
        if (is_null($producto)) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }
        $producto->delete();
        return response()->json(['mensaje' => 'producto eliminado con exito'], 200);
    }
    public function findByCodigo($codigo)
    {
        return Producto::where('codigo', $codigo)->first();
    }
}
