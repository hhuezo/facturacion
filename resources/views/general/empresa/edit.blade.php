@extends('menu')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.min.css') }}">
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Empresa
                    </div>
                    <div class="prism-toggle">

                    </div>
                </div>

                <form method="POST" action="{{ route('empresa.update', $empresa->id) }}">
                    @method('PUT')
                    @csrf

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-solid-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="bi bi-x"></i></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-solid-danger alert-dismissible fade show">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="bi bi-x"></i></button>
                            </div>
                        @endif
                        <div class="row gy-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="razon_social"
                                    value="{{ $empresa->razon_social }}" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Nombre comercial:</label>
                                <input type="text" class="form-control" name="nombre_comercial"
                                    value="{{ $empresa->razon_social }}" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">NIT:</label>
                                <input type="text" class="form-control" name="nit" value="{{ $empresa->nit }}"
                                    required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Dirección:</label>
                                <input type="text" class="form-control" name="direccion"
                                    value="{{ $empresa->direccion }}" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Correo:</label>
                                <input type="text" class="form-control" name="correo" value="{{ $empresa->correo }}"
                                    required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" name="telefono" value="{{ $empresa->telefono }}"
                                    required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Tipo contribuyente:</label>
                                <select name="tipo_contribuyente_id" class="form-select" required>
                                    <option value="">SELECCIONE</option>
                                    @foreach ($tipos_contribuyente as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ $tipo->id == $empresa->tipo_contribuyente_id ? 'selected' : '' }}>
                                            {{ $tipo->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Actividad ecnonómica:</label>
                                <select name="mh_actividad_economica_id" class="form-select select2" required>
                                    <option value="">SELECCIONE</option>
                                    @foreach ($actividades_economicas as $actividad)
                                        <option value="{{ $actividad->id }}"
                                            {{ $actividad->id == $empresa->mh_actividad_economica_id ? 'selected' : '' }}>
                                            {{ $actividad->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Tipo producto:</label>
                                <select name="mh_tipo_item_id" class="form-select" required>
                                    <option value="">SELECCIONE</option>
                                    @foreach ($tipos_item as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ $tipo->id == $empresa->mh_tipo_item_id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">NRC:</label>
                                <input type="text" class="form-control" name="nrc" value="{{ $empresa->nrc }}"
                                    required>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Agente de
                                    retención:&nbsp;&nbsp;</label>
                                <label class="switch">
                                    <input type="checkbox" name="agente_retencion"
                                        {{ $empresa->agente_retencion == 1 ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>




            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Sucursales
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-create">Nueva</button>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Responsable</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Departamento</th>
                                    <th scope="col">Municipio</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empresa->sucursales as $sucursal)
                                    <tr>
                                        <td>{{ $sucursal->codigo }}</td>
                                        <td>{{ $sucursal->responsable }}</td>
                                        <td>{{ $sucursal->telefono }}</td>
                                        <td>{{ $sucursal->correo }}</td>
                                        <td>{{ $sucursal->departamento->nombre }}</td>
                                        <td>{{ $sucursal->municipio->nombre }}</td>
                                        <td>{{ $sucursal->direccion }}</td>
                                        <td>
                                            @if ($sucursal->activo)
                                                <span class="badge bg-success-transparent">Activo</span>
                                            @else
                                                <span class="badge bg-danger-transparent">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 flex-wrap">
                                                <button class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-{{ $sucursal->id }}"><i
                                                        class="ri-edit-line"></i></button>
                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-{{ $sucursal->id }}"><i
                                                        class="ri-delete-bin-5-line"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('general.empresa.modal_edit')
                                    @include('general.empresa.modal_delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>




        </div>
    </div>



    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLgLabel">Crear sucursal</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('sucursal.store') }}">
                    <div class="modal-body">

                        @csrf

                        <div class="row gy-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Codigo:</label>
                                <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}"
                                    required>
                                <input type="hidden" class="form-control" name="empresa_id"
                                    value="{{ $empresa->id }}" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Responsable:</label>
                                <input type="text" class="form-control" name="responsable"
                                    value="{{ old('responsable') }}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Telefono:</label>
                                <input type="text" class="form-control" name="telefono"
                                    value="{{ old('telefono') }}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Correo:</label>
                                <input type="email" class="form-control" name="correo" value="{{ old('correo') }}"
                                    required>
                            </div>


                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Departamento:</label>
                                <select name="mh_departamento_id" id="mh_departamento_id" class="form-select" required>
                                    <option value="">SELECCIONE</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}"
                                            {{ old('mh_departamento_id') == $departamento->id ? 'selected' : '' }}>
                                            {{ $departamento->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Municipio:</label>
                                <select name="mh_municipio_id" id="mh_municipio_id" class="form-select" required>
                                    <option value="">SELECCIONE</option>
                                </select>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Dirección:</label>
                                <input type="text" class="form-control" name="direccion"
                                    value="{{ old('direccion') }}" required>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>


        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Activar Select2 en todos los elementos con la clase 'select2'
            $('.select2').select2();

            // Llamar a la función para expandir el menú y resaltar la opción Producto
            expandMenuAndHighlightOption('administracionMenu', 'empresa_Option');




            $('#mh_departamento_id').change(function() {
                var departamentoId = $(this).val(); // Obtener el ID del departamento seleccionado

                // Limpiar el select de "Municipio" antes de cargar nuevos datos
                $('#mh_municipio_id').html('<option value="">Cargando...</option>');

                // Si se selecciona un departamento válido
                if (departamentoId) {
                    // Realizar una solicitud AJAX para obtener los municipios
                    $.ajax({
                        url: "{{ url('getMunicipios') }}/" + departamentoId, // Ruta de la API
                        type: 'GET',
                        success: function(response) {
                            // Limpiar el select de "Municipio"
                            $('#mh_municipio_id').html('<option value="">SELECCIONE</option>');

                            // Llenar el select de "Municipio" con los datos recibidos
                            if (response.length > 0) {
                                $.each(response, function(index, municipio) {
                                    $('#mh_municipio_id').append(
                                        '<option value="' + municipio.id + '">' +
                                        municipio.nombre + '</option>'
                                    );
                                });
                            } else {
                                $('#mh_municipio_id').html(
                                    '<option value="">NO HAY MUNICIPIOS</option>');
                            }
                        },
                        error: function() {
                            $('#mh_municipio_id').html(
                                '<option value="">ERROR AL CARGAR MUNICIPIOS</option>');
                        }
                    });
                } else {
                    // Si no se selecciona un departamento, limpiar el select de "Municipio"
                    $('#mh_municipio_id').html(
                        '<option value="">SELECCIONE UN DEPARTAMENTO PRIMERO</option>');
                }
            });






            $('select[name="mh_departamento_id"]').change(function() {
                var departamentoId = $(this).val();
                var sucursalId = $(this).attr('id').split('_').pop();
                var municipioSelect = $('#mh_municipio_id_' + sucursalId);

                // Limpiar el select de municipio
                municipioSelect.html('<option value="">Cargando...</option>');

                if (departamentoId) {

                    $.ajax({
                        url: "{{ url('getMunicipios') }}/" + departamentoId, // Ruta de la API
                        type: 'GET',
                        success: function(response) {
                            // Limpiar el select de municipio
                            municipioSelect.html('<option value="">SELECCIONE</option>');

                            // Llenar el select de municipio con los datos recibidos
                            if (response.length > 0) {
                                $.each(response, function(index, municipio) {
                                    municipioSelect.append(
                                        '<option value="' + municipio.id + '">' +
                                        municipio.nombre + '</option>'
                                    );
                                });
                            } else {
                                municipioSelect.html(
                                    '<option value="">NO HAY MUNICIPIOS</option>');
                            }
                        },
                        error: function() {
                            municipioSelect.html(
                                '<option value="">ERROR AL CARGAR MUNICIPIOS</option>');
                        }
                    });
                } else {
                    // Si no se selecciona un departamento, limpiar el select de municipio
                    municipioSelect.html('<option value="">SELECCIONE UN DEPARTAMENTO PRIMERO</option>');
                }
            });








        });
    </script>
@endsection
