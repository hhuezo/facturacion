<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\general\EmpresaSucursal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SucursalController extends Controller
{

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string|max:50',
            'empresa_id' => 'required|exists:empresa,id', // Asegura que el empresa_id exista en la tabla empresas
            'responsable' => 'nullable|string|max:100',
            'correo' => 'required|email|max:100',
            'telefono' => 'required|string|max:20',
            'mh_departamento_id' => 'required|exists:mh_departamento,id', // Asegura que el departamento exista
            'mh_municipio_id' => 'required|exists:mh_municipio,id', // Asegura que el municipio exista
            'direccion' => 'required|string|max:255',
        ]);

        // Si la validación falla, redirigir con errores
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $sucursal = new EmpresaSucursal();
            $sucursal->codigo = $request->codigo;
            $sucursal->empresa_id = $request->empresa_id;
            $sucursal->responsable = $request->responsable;
            $sucursal->correo = $request->correo;
            $sucursal->telefono = $request->telefono;
            $sucursal->mh_departamento_id = $request->mh_departamento_id;
            $sucursal->mh_municipio_id = $request->mh_municipio_id;
            $sucursal->direccion = $request->direccion;
            $sucursal->user_id = auth()->user()->id;
            $sucursal->save();

            // Redirigir con un mensaje de éxito
            return back()->with('success', 'Sucursal creada exitosamente.');
        } catch (Exception $e) {
            // Manejar la excepción y redirigir con un mensaje de error
            return back()
                ->with('error', 'Ocurrió un error al crear la sucursal: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string|max:50',
            'empresa_id' => 'required|exists:empresa,id', // Asegura que el empresa_id exista en la tabla empresas
            'responsable' => 'nullable|string|max:100',
            'correo' => 'required|email|max:100',
            'telefono' => 'required|string|max:20',
            'mh_departamento_id' => 'required|exists:mh_departamento,id', // Asegura que el departamento exista
            'mh_municipio_id' => 'required|exists:mh_municipio,id', // Asegura que el municipio exista
            'direccion' => 'required|string|max:255',
        ]);

        // Si la validación falla, redirigir con errores
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $sucursal = EmpresaSucursal::findOrFail($id);

            $sucursal->codigo = $request->codigo;
            $sucursal->empresa_id = $request->empresa_id;
            $sucursal->responsable = $request->responsable;
            $sucursal->correo = $request->correo;
            $sucursal->telefono = $request->telefono;
            $sucursal->mh_departamento_id = $request->mh_departamento_id;
            $sucursal->mh_municipio_id = $request->mh_municipio_id;
            $sucursal->direccion = $request->direccion;
            $sucursal->save();

            return back()->with('success', 'Sucursal actualizada exitosamente.');
        } catch (Exception $e) {
            // Manejar la excepción y redirigir con un mensaje de error
            return back()
                ->with('error', 'Ocurrió un error al actualizar la sucursal: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {

            $sucursal = EmpresaSucursal::findOrFail($id);
            $sucursal->delete();

            return back()->with('success', 'Sucursal eliminada exitosamente.');
        } catch (Exception $e) {
            // Manejar la excepción y redirigir con un mensaje de error
            return back()
                ->with('error', 'Ocurrió un error al eliminar la sucursal: ' . $e->getMessage())
                ->withInput();
        }
    }
}
