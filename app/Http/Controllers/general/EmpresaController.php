<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\catalogo\TipoContribuyente;
use App\Models\catalogo\TipoNegocio;
use App\Models\catalogo\TipoProducto;
use App\Models\general\Empresa;
use App\Models\hacienda\ActividadEconomica;
use App\Models\hacienda\Departamento;
use App\Models\hacienda\Municipio;
use App\Models\hacienda\TipoItem;
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
        $actividades_economicas = ActividadEconomica::where('activo', 1)->get();
        $tipos_item = TipoItem::where('activo', 1)->get();
        $departamentos = Departamento::get();

        return view('general.empresa.edit', compact('empresa', 'tipos_contribuyente', 'actividades_economicas', 'tipos_item','departamentos'));
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
                'mh_actividad_economica_id' => 'required|exists:mh_actividad_economica,id',
                'mh_tipo_item_id' => 'required|exists:mh_tipo_item,id',
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
                'mh_actividad_economica_id' => $request->input('mh_actividad_economica_id'),
                'mh_tipo_item_id' => $request->input('mh_tipo_item_id'),
                'nrc' => $request->input('nrc'),
                'agente_retencion' => $request->input('agente_retencion') ? 1 : 0,  // Asignar 1 o 0 dependiendo del estado del checkbox
            ]);


            //alert()->success('El registro ha sido agregado correctamente');

            // Redirigir con un mensaje de éxito
            return back()->with('success', 'Los datos de la empresa se han actualizado correctamente.');
        } catch (\Exception $e) {
            // En caso de error, redirigir con un mensaje de error
            return back()->with('error', 'Error al guardar la información. Inténtelo nuevamente.');
        }
    }

    public function destroy($id)
    {
        //
    }


    public function getMunicipios($id)
    {
        return Municipio::where('mh_departamento_id',$id)->get();
    }
}
