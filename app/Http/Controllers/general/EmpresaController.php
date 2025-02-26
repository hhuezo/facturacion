<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\catalogo\TipoContribuyente;
use App\Models\catalogo\TipoNegocio;
use App\Models\catalogo\TipoProducto;
use App\Models\general\Empresa;
use App\Models\User;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        // Obtener el id de la primera empresa asociada al usuario
        $id = $user->empresas->first()->id;

        return redirect('empresa/' . $id . '/edit');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);
        $tipos_contribuyente = TipoContribuyente::where('activo', 1)->get();
        $tipos_negocio = TipoNegocio::where('activo', 1)->get();
        $tipos_producto = TipoProducto::where('activo', 1)->get();

        return view('general.empresa.edit', compact('empresa', 'tipos_contribuyente', 'tipos_negocio', 'tipos_producto'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar los datos del formulario
            $validated = $request->validate([
                'razon_social' => 'required|string|max:255',
                'nombre_comercial' => 'required|string|max:255',
                'nit' => 'required|string|max:20',
                'direccion' => 'required|string|max:255',
                'correo' => 'required|email|max:255',
                'telefono' => 'required|string|max:20',
                'tipo_contribuyente_id' => 'required|exists:tipo_contribuyente,id',
                'tipo_negocio_id' => 'required|exists:tipo_negocio,id',
                'tipo_producto_id' => 'required|exists:tipo_producto,id',
                'nrc' => 'required|string|max:20',
                //'agente_retencion' => 'nullable|boolean',
            ]);

            // Encontrar la empresa por ID
            $empresa = Empresa::findOrFail($id);

            // Actualizar los campos de la empresa
            $empresa->update([
                'razon_social' => $request->input('razon_social'),
                'nombre_comercial' => $request->input('nombre_comercial'),
                'nit' => $request->input('nit'),
                'direccion' => $request->input('direccion'),
                'correo' => $request->input('correo'),
                'telefono' => $request->input('telefono'),
                'tipo_contribuyente_id' => $request->input('tipo_contribuyente_id'),
                'tipo_negocio_id' => $request->input('tipo_negocio_id'),
                'tipo_producto_id' => $request->input('tipo_producto_id'),
                'nrc' => $request->input('nrc'),
                'agente_retencion' => $request->input('agente_retencion') ? 1 : 0,  // Asignar 1 o 0 dependiendo del estado del checkbox
            ]);

            // Redirigir con un mensaje de éxito
            return back()->with('success', 'Los datos de la empresa se han actualizado correctamente.');
        } catch (\Exception $e) {
            // En caso de error, redirigir con un mensaje de error
            return back()->with('error', 'Error al guardar la información. Inténtelo nuevamente.');
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
        //
    }
}
