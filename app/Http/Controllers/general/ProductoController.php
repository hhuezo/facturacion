<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\catalogo\TipoIva;
use App\Models\catalogo\TipoProducto;
use App\Models\catalogo\UnidadMedida;
use App\Models\general\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        // Obtener el id de la primera empresa asociada al usuario
        $empresa_id = $user->empresas->first()->id;

        // Obtener los productos activos de la empresa
        $productos = Producto::where('empresa_id', $empresa_id)->where('activo', 1)->get();

        // Obtener los tipos de IVA, tipos de producto y unidades de medida activos
        $tipos_iva = TipoIva::where('activo', 1)->get();
        $tipos_producto = TipoProducto::where('activo', 1)->get();
        $unidades_medida = UnidadMedida::where('activo', 1)->get();

        // Calcular el código del nuevo producto
        $ultimoProducto = Producto::where('empresa_id', $empresa_id)->orderByDesc('codigo')->first();

        $codigoProducto = 'P001'; // Código por defecto si no hay productos
        if ($ultimoProducto) {
            // Extraemos el número del código del último producto y lo incrementamos
            $codigoUltimo = substr($ultimoProducto->codigo, 1); // Obtener la parte numérica del código
            $nuevoCodigo = 'P' . str_pad((int)$codigoUltimo + 1, 3, '0', STR_PAD_LEFT); // Incrementamos y lo formateamos
            $codigoProducto = $nuevoCodigo;
        }
        return view('general.producto.index', compact('productos', 'tipos_iva', 'tipos_producto', 'unidades_medida', 'codigoProducto'));
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'codigo' => 'required|string|max:10|unique:producto,codigo',
                'barra' => 'nullable|string|max:10',
                'descripcion' => 'required|string|max:255',
                'tipo_iva_id' => 'required|exists:tipo_iva,id',
                'tipo_producto_id' => 'nullable|exists:tipo_producto,id',
                'unidad_medida_id' => 'nullable|exists:unidad_medida,id',
            ]);

            $user = User::findOrFail(auth()->user()->id);
            $empresa_id = $user->empresas->first()->id;

            $producto = new Producto();
            $producto->codigo = $validated['codigo'];
            $producto->barra = $validated['barra'] ?? null;
            $producto->descripcion = $validated['descripcion'];
            $producto->tipo_iva_id = $validated['tipo_iva_id'];
            $producto->tipo_producto_id = $validated['tipo_producto_id'] ?? null;
            $producto->unidad_medida_id = $validated['unidad_medida_id'] ?? null;
            $producto->empresa_id = $empresa_id;
            $producto->activo = 1;

            $producto->save();

            return back()->with('success', 'Producto creado exitosamente.');
        } catch (\Exception $e) {
            alert()->error('Ocurrió un error al crear el producto. Inténtelo nuevamente.');
            return back()->with('error', 'Ocurrió un error al crear el producto. Inténtelo nuevamente.');
        }
    }



    public function show($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $producto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            // Validación de los datos del formulario
            $validated = $request->validate([
                'codigo' => 'required|string|max:10',
                'barra' => 'nullable|string|max:10',
                'descripcion' => 'required|string|max:255',
                'tipo_iva_id' => 'required|exists:tipo_iva,id',
                'tipo_producto_id' => 'nullable|exists:tipo_producto,id',
                'unidad_medida_id' => 'nullable|exists:unidad_medida,id',
            ]);

            // Encuentra el producto por su ID
            $producto = Producto::findOrFail($id);

            // Actualiza los valores del producto
            $producto->codigo = $validated['codigo'];
            $producto->barra = $validated['barra'] ?? null;
            $producto->descripcion = $validated['descripcion'];
            $producto->tipo_iva_id = $validated['tipo_iva_id'];
            $producto->tipo_producto_id = $validated['tipo_producto_id'] ?? null;
            $producto->unidad_medida_id = $validated['unidad_medida_id'] ?? null;

            // Guarda los cambios
            $producto->save();

            return back()->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, muestra un mensaje de error
            alert()->error('Ocurrió un error al actualizar el producto. Inténtelo nuevamente.')->toast();
            return back()->with('error', 'Ocurrió un error al actualizar el producto. Inténtelo nuevamente.');
        }
    }


    public function destroy($id)
    {
        try {
            // Buscar el cliente por su ID
            $producto = Producto::findOrFail($id);

            // Actualizar el campo 'activo' a 0
            $producto->activo = 0;
            $producto->save();

            return back()->with('success', 'Producto desactivado con éxito!');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al desactivar el producto: ' . $e->getMessage());
        }
    }
}
