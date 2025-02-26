<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use App\Models\catalogo\FormaPago;
use App\Models\facturacion\ConsumidorFinal;
use App\Models\general\Cliente;
use App\Models\general\Producto;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ConsumidorFinalController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        $empresa_id = $user->empresas->first()->id;

        $consumidor_final = ConsumidorFinal::where('empresa_id', $empresa_id)->get();

        return view('facturacion.consumidor_final.index', compact('consumidor_final'));
    }

    public function create()
    {
        $user = User::findOrFail(auth()->user()->id);

        $empresa_id = $user->empresas->first()->id;
        $clientes = Cliente::where('empresa_id', $empresa_id)->get();

        // Consultamos todas las formas de pago
        $formasPago = FormaPago::where('activo',1)->get();

        return view('facturacion.consumidor_final.create', compact('clientes', 'formasPago'));
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos del formulario
            $request->validate([
                'fecha' => 'required|date',
                'cliente_id' => 'required|exists:cliente,id',
                'direccion' => 'required|string|max:255',
                'telefono' => 'required|string|max:15',
                'correo' => 'required|email',
                'forma_pago_id' => 'required|exists:forma_pago,id',
            ]);

            // Crear una nueva instancia de ConsumidorFinal con los datos validados
            $consumidorFinal = new ConsumidorFinal();
            $consumidorFinal->fecha = $request->fecha;
            $consumidorFinal->cliente_id = $request->cliente_id;
            $consumidorFinal->direccion = $request->direccion;
            $consumidorFinal->telefono = $request->telefono;
            $consumidorFinal->correo = $request->correo;
            $consumidorFinal->forma_pago_id = $request->forma_pago_id;

            // Guardar el registro en la base de datos
            $consumidorFinal->save();

            // Redirigir a una página con un mensaje de éxito
            return redirect('consumidor_final/' . $consumidorFinal->id . '/edit');
        } catch (Exception $e) {
            // Capturar cualquier error y devolver un mensaje de error
            return back()->withErrors(['error' => 'Hubo un problema al guardar los datos. Intente nuevamente.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail(auth()->user()->id);

        $empresa_id = $user->empresas->first()->id;
        $clientes = Cliente::where('empresa_id', $empresa_id)->get();

        // Consultamos todas las formas de pago
        $formasPago = FormaPago::where('activo',1)->get();
        $consumidorFinal =ConsumidorFinal::findOrFail($id);
        $productos = Producto::where('empresa_id', $empresa_id)->get();
        return view('facturacion.consumidor_final.edit',compact('consumidorFinal','clientes', 'formasPago','productos'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
