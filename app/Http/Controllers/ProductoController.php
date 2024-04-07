<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
        try {
            $request->validate([
            'nombre' => 'required|unique:productos', // Validar que el nombre sea requerido y único en la tabla de productos
            'codigo' => 'required|unique:productos', // Validar que el código sea requerido y único en la tabla de productos
            'precio' => 'required',
            'stock' => 'required',
            'stock_minimo' => 'required',
            'categoria_id' => 'required',
            'marca_id' => 'required'

            ], [
                'nombre.required' => 'El nombre del producto es obligatorio.',
                'nombre.unique' => 'La Producto ya existe.',
                'codigo.required' => 'El codigo del producto es obligatorio.',
                'codigo.unique' => 'La Producto ya existe.',
                'precio.required' => 'El precio del producto es obligatorio.',
                'stock.required' => 'El stock del producto es obligatorio.',
                'stock_minimo.required' => 'El stock_minimo del producto es obligatorio.',
                'categoria_id.required' => 'La categoria del producto es obligatorio.',
                'marca_id.required' => 'La marca del producto es obligatorio.'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()->first(), 'status' => 400], 400);
        }
        $nuevoProd = new Producto();
        $nuevoProd->nombre = strtolower($request->nombre);
        $nuevoProd->codigo = $request->codigo;
        if ($archivo = $request->file('imagen')) {
            $nombre = $archivo->getClientOriginalName();
            $archivo->move('images', $nombre);
            $nuevoProd->imagen = $nombre;
        } else {
            $nuevoProd->imagen = 'noimage.jpg';
        }
        $nuevoProd->descripcion = strtolower($request->descripcion);
        $nuevoProd->precio = $request->precio;
        $nuevoProd->fecha_vencimiento = $request->fecha_vencimiento;
        $nuevoProd->stock = $request->stock;
        $nuevoProd->stock_minimo = $request->stock_minimo;
        $nuevoProd->categoria_id = $request->categoria_id;
        $nuevoProd->marca_id = $request->marca_id;

        $nuevoProd->save();
        return response()->json(['mensaje' => 'Producto creado con exito'], 201);
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
          $request->validate([
        'nombre' => 'unique:productos,nombre,' . $producto->id,
        'codigo' => 'unique:productos,codigo,' . $producto->id,
        'categoria_id' => 'exists:categorias,id',
    ]);
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
        if ($request->has('marca_id')) {
            $producto->marca_id = $request->marca_id;
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
