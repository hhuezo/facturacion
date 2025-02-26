@extends('menu')
@section('contenido')
    <!-- Start::row-1 -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        Clientes
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">Nuevo</button>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Código</th>
                                    <th>Razón Social</th>
                                    <th>Nombre Comercial</th>
                                    <th>Tipo Identificación</th>
                                    <th>Número Documento</th>
                                    <th>NRC</th>
                                    <th>Género</th>
                                    <th>Ciudad</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Operadora Teléfono</th>
                                    <th>Teléfono</th>
                                    <th>Tipo Contribuyente</th>
                                    <th>Tipo Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-warning btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-{{ $cliente->id }}">
                                                &nbsp;<i class="ri-edit-line align-middle me-2 d-inline-block"></i></button>
                                            &nbsp;
                                            <button class="btn btn-sm btn-danger btn-wave" data-bs-toggle="modal"
                                            data-bs-target="#modal-delete-{{ $cliente->id }}">
                                                &nbsp;<i
                                                    class="ri-delete-bin-line align-middle me-2 d-inline-block"  ></i></button>
                                        </td>
                                        <td>{{ $cliente->codigo }}</td>
                                        <td>{{ $cliente->razon_social }}</td>
                                        <td>{{ $cliente->nombre_comercial }}</td>
                                        <td>{{ $cliente->tipoIdentificacion->descripcion ?? '' }}</td>
                                        <td>{{ $cliente->numero_documento }}</td>
                                        <td>{{ $cliente->nrc }}</td>
                                        <td>{{ $cliente->genero == 1 ? 'Masculino' : ($cliente->genero == 2 ? 'Femenino' : ($cliente->genero == 3 ? 'Otro' : '')) }}
                                        </td>
                                        <td>{{ $cliente->ciudad }}</td>
                                        <td>{{ $cliente->direccion }}</td>
                                        <td>{{ $cliente->correo }}</td>
                                        <td>{{ $cliente->operadoraTelefono->descripcion ?? '' }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->tipoContribuyente->descripcion ?? '' }}</td>
                                        <td>{{ $cliente->tipoCliente->descripcion ?? '' }}</td>
                                    </tr>

                                    @include('general.cliente.edit')
                                    @include('general.cliente.delete')
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
                    <h6 class="modal-title" id="exampleModalLgLabel">Crear Cliente</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('cliente.store') }}">
                        @csrf

                        <div class="row gy-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Razón social:</label>
                                <input type="text" class="form-control" name="razon_social"
                                    value="{{ old('razon_social') }}" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Nombre comercial:</label>
                                <input type="text" class="form-control" name="nombre_comercial"
                                    value="{{ old('nombre_comercial') }}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Tipo identificación:</label>
                                <select name="tipo_identificacion_id" class="form-select" required>
                                    <option value="">SELECCIONE</option>
                                    @foreach ($tipos_identificacion as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ old('tipo_identificacion_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Número de documento:</label>
                                <input type="text" class="form-control" name="numero_documento"
                                    value="{{ old('numero_documento') }}" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">NRC:</label>
                                <input type="text" class="form-control" name="nrc" value="{{ old('nrc') }}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Género:</label>
                                <select name="genero" class="form-select">
                                    <option value="">SELECCIONE</option>
                                    <option value="1" {{ old('genero') == 1 ? 'selected' : '' }}>Masculino</option>
                                    <option value="2" {{ old('genero') == 2 ? 'selected' : '' }}>Femenino</option>
                                    <option value="3" {{ old('genero') == 3 ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Ciudad:</label>
                                <input type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Dirección:</label>
                                <input type="text" class="form-control" name="direccion"
                                    value="{{ old('direccion') }}" required>
                            </div>


                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Compañia telefónica:</label>
                                <select name="operadora_telefono_id" class="form-select">
                                    <option value="">SELECCIONE</option>
                                    @foreach ($operadores_telefono as $operador)
                                        <option value="{{ $operador->id }}"
                                            {{ old('operadora_telefono_id') == $operador->id ? 'selected' : '' }}>
                                            {{ $operador->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" name="telefono"
                                    value="{{ old('telefono') }}" required>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Correo:</label>
                                <input type="email" class="form-control" name="correo" value="{{ old('correo') }}"
                                    required>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Tipo contribuyente:</label>
                                <select name="tipo_contribuyente_id" class="form-select" required>
                                    <option value="">SELECCIONE</option>
                                    @foreach ($tipos_contribuyente as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ old('tipo_contribuyente_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="input-label" class="form-label">Tipo cliente:</label>
                                <select name="tipo_cliente_id" class="form-select" required>
                                    <option value="">SELECCIONE</option>
                                    @foreach ($tipos_cliente as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ old('tipo_cliente_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>

            </form>
        </div>
    </div>






    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <!-- Datatables Cdn -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- Internal Datatables JS -->
    <script src="{{ asset('assets/js/datatables.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            expandMenuAndHighlightOption('administracionMenu', 'cliente_Option');

        });
    </script>
@endsection
