<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    private function obtenerProductos()
    {
        $productos = Producto::select('id', 'nombre', 'descripcion', 'talla', 'precio', 'stock', 'url', 'created_at')
            ->get();

        return compact('productos');
    }

    public function index()
    {
        $productos = Producto::all();
        return view('Shop', compact('productos'));
    }

    public function showForm()
    {
        return view('ShopShow');
    }

    public function create()
    {
        return view('ShopAdd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'talla' => 'required|numeric',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'url' => 'nullable|string|max:255',
        ]);

        DB::select('CALL sp_ins_prod_yair(?, ?, ?, ?, ?, ?)', [
            $request->nombre,
            $request->descripcion,
            $request->talla,
            $request->precio,
            $request->stock,
            $request->url,
        ]);

        return redirect()->route('Shop')->with('success', 'Producto creado correctamente.');
    }

    public function show($id)
    {
        $producto = DB::select('CALL sp_get_prod_yair()');
        $producto = collect($producto)->firstWhere('id', $id);

        if (!$producto) {
            return redirect()->route('Shop')->withErrors('El producto no existe.');
        }

        return view('ShopShow', compact('producto'));
    }

    public function editar($id)
    {
        $producto = DB::select('CALL sp_get_prod_yair()');
        $producto = collect($producto)->firstWhere('id', $id);

        if (!$producto) {
            return redirect()->back()->withErrors('El producto no existe.');
        }

        return view('ShopUpdate', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'talla' => 'required|numeric',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'url' => 'nullable|string|max:255',
        ]);

        // Llamada al procedimiento almacenado para actualizar producto
        DB::select('CALL sp_upd_prod_yair(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $request->nombre,
            $request->descripcion,
            $request->talla,
            $request->precio,
            $request->stock,
            $request->url,
        ]);

        return redirect()->route('Shop')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::select('CALL sp_del_prod_yair(?)', [$id]);
        return redirect()->route('Shop')->with('success', 'Producto eliminado correctamente.');
    }
}
