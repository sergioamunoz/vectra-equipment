<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Routing\Controller; // <-- Heredamos de la clase base global de Laravel

class ProductController extends Controller
{
    // READ: Mostrar listado de inventario
    public function inventario()
    {
        $productos = Product::all();
        return view('inventario', compact('productos'));
    }

    // CREATE: Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string'
        ]);

        $producto = new Product();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion ?? 'Sin descripción';
        $producto->save();

        return redirect('/inventario')->with('exito', '¡Producto guardado correctamente en la base de datos!');
    }

    // UPDATE (Paso 1): Mostrar el formulario de edición con los datos actuales
    public function edit($id)
    {
        $producto = Product::find($id);
        return view('editar-producto', compact('producto'));
    }

    // UPDATE (Paso 2): Recoger los cambios y actualizar el registro
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string'
        ]);

        $producto = Product::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->save();

        return redirect('/inventario')->with('exito', '¡Producto actualizado correctamente!');
    }

    // DELETE: Eliminar un producto por su ID
    public function destroy($id)
    {
        $producto = Product::find($id);
        if ($producto) {
            $producto->delete();
        }

        return redirect('/inventario')->with('exito', '¡Producto eliminado de la base de datos correctamente!');
    }
}