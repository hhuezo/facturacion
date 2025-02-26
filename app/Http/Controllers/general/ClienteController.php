<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\catalogo\OperadoraTelefono;
use App\Models\catalogo\TipoCliente;
use App\Models\catalogo\TipoContribuyente;
use App\Models\catalogo\TipoIdentificacion;
use App\Models\general\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        $empresas_id = $user->empresas->pluck('id')->toArray();

        $clientes = Cliente::whereIn('empresa_id', $empresas_id)->where('activo', 1)->get();

        $tipos_identificacion  = TipoIdentificacion::where('activo', 1)->get();
        $tipos_contribuyente  = TipoContribuyente::where('activo', 1)->get();
        $tipos_cliente   = TipoCliente::where('activo', 1)->get();
        $operadores_telefono   = OperadoraTelefono::where('activo', 1)->get();

        return view('general.cliente.index', compact('clientes', 'tipos_identificacion', 'tipos_contribuyente', 'tipos_cliente', 'operadores_telefono'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $request->validate([
                'razon_social' => 'required|string|max:255',
                'nombre_comercial' => 'nullable|string|max:255',
                'tipo_identificacion_id' => 'required|integer',
                'numero_documento' => 'required|string|max:30',
                'nrc' => 'nullable|string|max:20',
                'genero' => 'nullable|integer',
                'ciudad' => 'nullable|string|max:255',
                'direccion' => 'required|string|max:255',
                'correo' => 'required|email|max:100',
                'telefono' => 'required|string|max:20',
                'tipo_contribuyente_id' => 'required|integer',
                'tipo_cliente_id' => 'required|integer',
            ]);

            // Get the authenticated user's associated companies
            $user = User::findOrFail(auth()->user()->id);
            $empresas_id = $user->empresas->pluck('id')->toArray();

            $empresa_id = $empresas_id ? $empresas_id[0] : null;


            $clientCount = Cliente::where('empresa_id', $empresa_id)->count();
            $newCode = 'C' . str_pad($clientCount + 1, 3, '0', STR_PAD_LEFT);

            // Create a new client record in the database
            $client = new Cliente();
            $client->codigo = $newCode;  // Use the dynamically calculated code
            $client->razon_social = $request->razon_social;
            $client->nombre_comercial = $request->nombre_comercial;
            $client->tipo_identificacion_id = $request->tipo_identificacion_id;
            $client->numero_documento = $request->numero_documento;
            $client->nrc = $request->nrc;
            $client->genero = $request->genero;
            $client->ciudad = $request->ciudad;
            $client->direccion = $request->direccion;
            $client->correo = $request->correo;
            $client->telefono = $request->telefono;
            $client->tipo_contribuyente_id = $request->tipo_contribuyente_id;
            $client->tipo_cliente_id = $request->tipo_cliente_id;
            $client->operadora_telefono_id = $request->operadora_telefono_id;
            $client->activo = 1;  // set active status by default
            $client->empresa_id = $empresa_id;  // assign the dynamically calculated empresa_id

            // Save the client record
            $client->save();

            // Return to the previous page with success message
            return back()->with('success', 'Cliente creado con éxito!');
        } catch (\Exception $e) {
            // If an error occurs, return back with error message
            return back()->with('error', 'Hubo un error al crear el cliente: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            return response()->json($cliente);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Cliente no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error inesperado'
            ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validar los datos de la solicitud
            $request->validate([
                'razon_social' => 'required|string|max:255',
                'nombre_comercial' => 'nullable|string|max:255',
                'tipo_identificacion_id' => 'required|integer',
                'numero_documento' => 'required|string|max:30',
                'nrc' => 'nullable|string|max:20',
                'genero' => 'nullable|integer',
                'ciudad' => 'nullable|string|max:255',
                'direccion' => 'required|string|max:255',
                'correo' => 'required|email|max:100',
                'telefono' => 'required|string|max:20',
                'tipo_contribuyente_id' => 'required|integer',
                'tipo_cliente_id' => 'required|integer',
            ]);

            // Obtener el cliente a actualizar
            $cliente = Cliente::findOrFail($id);

            // Actualizar los datos del cliente
            $cliente->razon_social = $request->razon_social;
            $cliente->nombre_comercial = $request->nombre_comercial;
            $cliente->tipo_identificacion_id = $request->tipo_identificacion_id;
            $cliente->numero_documento = $request->numero_documento;
            $cliente->nrc = $request->nrc;
            $cliente->genero = $request->genero;
            $cliente->ciudad = $request->ciudad;
            $cliente->direccion = $request->direccion;
            $cliente->correo = $request->correo;
            $cliente->telefono = $request->telefono;
            $cliente->tipo_contribuyente_id = $request->tipo_contribuyente_id;
            $cliente->tipo_cliente_id = $request->tipo_cliente_id;
            $cliente->operadora_telefono_id = $request->operadora_telefono_id;

            // Guardar los cambios en la base de datos
            $cliente->save();

            // Retornar a la página anterior con un mensaje de éxito
            return back()->with('success', 'Cliente actualizado con éxito!');
        } catch (\Exception $e) {
            // Si ocurre un error, retornar con un mensaje de error
            return back()->with('error', 'Hubo un error al actualizar el cliente: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Buscar el cliente por su ID
            $cliente = Cliente::findOrFail($id);

            // Actualizar el campo 'activo' a 0
            $cliente->activo = 0;
            $cliente->save();

            return back()->with('success', 'Cliente desactivado con éxito!');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al desactivar el cliente: ' . $e->getMessage());
        }
    }
}
