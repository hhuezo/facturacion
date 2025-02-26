@extends('menu')
@section('contenido')
    <!-- Start::row-1 -->


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])


    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        Productos
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
                                    <th>Descripción</th>
                                    <th>Código de Barra</th>
                                    <th>Tipo IVA</th>
                                    <th>Tipo Producto</th>
                                    <th>Unidad de Medida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-warning btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-{{ $producto->id }}">
                                                &nbsp;<i class="ri-edit-line align-middle me-2 d-inline-block"></i></button>
                                            &nbsp;
                                            <button class="btn btn-sm btn-danger btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-{{ $producto->id }}">
                                                &nbsp;<i
                                                    class="ri-delete-bin-line align-middle me-2 d-inline-block"></i></button>
                                        </td>
                                        <td>{{ $producto->codigo }}</td>
                                        <td>{{ $producto->descripcion }}</td>
                                        <td>{{ $producto->barra }}</td>
                                        <td>{{ $producto->tipoIva->descripcion ?? 'N/A' }}</td>
                                        <td>{{ $producto->tipoProducto->descripcion ?? 'N/A' }}</td>
                                        <td>{{ $producto->unidadMedida->descripcion ?? 'N/A' }}</td>
                                    </tr>

                                    @include('general.producto.edit')
                                    @include('general.producto.delete')
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Producto -->
    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLgLabel">Crear Producto</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('producto.store') }}">
                        @csrf

                        <div class="row gy-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="barra" class="form-label">Código de Barra:</label>
                                <input type="text" class="form-control" name="barra" value="{{ $codigoProducto }}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="codigo" class="form-label">Código:</label>
                                <input type="text" class="form-control" name="codigo" value="{{ $codigoProducto }}"
                                    required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" name="descripcion"
                                    value="{{ old('descripcion') }}" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="tipo_iva_id" class="form-label">Tipo de IVA:</label>
                                <select name="tipo_iva_id" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($tipos_iva as $tipoIva)
                                        <option value="{{ $tipoIva->id }}"
                                            {{ old('tipo_iva_id') == $tipoIva->id ? 'selected' : '' }}>
                                            {{ $tipoIva->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="tipo_producto_id" class="form-label">Tipo de Producto:</label>
                                <select name="tipo_producto_id" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($tipos_producto as $tipoProducto)
                                        <option value="{{ $tipoProducto->id }}"
                                            {{ old('tipo_producto_id') == $tipoProducto->id ? 'selected' : '' }}>
                                            {{ $tipoProducto->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="unidad_medida_id" class="form-label">Unidad de Medida:</label>
                                <select name="unidad_medida_id" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($unidades_medida as $unidadMedida)
                                        <option value="{{ $unidadMedida->id }}"
                                            {{ old('unidad_medida_id') == $unidadMedida->id ? 'selected' : '' }}>
                                            {{ $unidadMedida->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
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
            expandMenuAndHighlightOption('administracionMenu', 'producto_Option');

        });
    </script>
@endsection
