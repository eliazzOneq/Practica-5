<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return response()->json(Producto::all(), 200);
    }

    public function store(Request $request)
    {
        if (!$request->user()->tokenCan('crear')) {
            return response()->json(['mensaje' => 'No tienes permiso para crear productos.'], 403);
        }
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean',
        ]);

        $producto = Producto::create($data);

        return response()->json($producto, 201);
    }

    public function show(Producto $producto)
    {
        return response()->json($producto, 200);
    }

    public function update(Request $request, Producto $producto)
    {
        if (!$request->user()->tokenCan('editar')) {
            return response()->json([
                'mensaje' => 'No tienes permiso para editar productos.'
            ], 403);
        }
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean',
        ]);

        $producto->update($data);

        return response()->json($producto, 200);
    }

    public function destroy(Request $request, Producto $producto)
    {
        if (!$request->user()->tokenCan('eliminar')) {
            return response()->json([
                'mensaje' => 'No tienes permiso para eliminar productos.'
            ], 403);
        }

        $producto->delete();
        return response()->json([
            'mensaje' => 'Producto eliminado correctamente'
        ], 200);
    }
}