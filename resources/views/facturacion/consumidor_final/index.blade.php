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
                        Consumidor final
                    </div>
                    <div class="prism-toggle">
                       <a href="{{url('consumidor_final/create')}}"> <button class="btn btn-primary">Nuevo</button></a>
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
                                    <th>Fecha</th>
                                    <th>Código Cliente</th>
                                    <th>Nombre Cliente</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Número Factura</th>
                                    <th>Forma de Pago</th>
                                    <th>Retener IVA</th>
                                    <th>Retener Renta</th>
                                    <th>Observación</th>
                                    <th>Estado Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consumidor_final as $consumidor)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-warning btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-{{ $consumidor->id }}">
                                                &nbsp;<i class="ri-edit-line align-middle me-2 d-inline-block"></i></button>
                                            &nbsp;
                                            <button class="btn btn-sm btn-danger btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-{{ $consumidor->id }}">
                                                &nbsp;<i class="ri-delete-bin-line align-middle me-2 d-inline-block"></i></button>
                                        </td>
                                        <td>{{ $consumidor->fecha }}</td>
                                        <td>{{ $consumidor->cliente->codigo ?? '' }}</td>
                                        <td>{{ $consumidor->cliente->razon_social ?? '' }}</td>
                                        <td>{{ $consumidor->direccion }}</td>
                                        <td>{{ $consumidor->telefono }}</td>
                                        <td>{{ $consumidor->correo }}</td>
                                        <td>{{ $consumidor->numero_factura }}</td>
                                        <td>{{ $consumidor->formaPago->descripcion ?? '' }}</td>
                                        <td>{{ $consumidor->retener_iva == 1 ? 'Sí' : 'No' }}</td>
                                        <td>{{ $consumidor->retener_renta == 1 ? 'Sí' : 'No' }}</td>
                                        <td>{{ $consumidor->observacion }}</td>
                                        <td>{{ $consumidor->estadoFactura->descripcion ?? '' }}</td>
                                    </tr>

                                    @include('general.consumidor_final.edit')
                                    @include('general.consumidor_final.delete')
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
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
            expandMenuAndHighlightOption('facturacionMenu', 'consumidor_final_Option');

        });
    </script>
@endsection
