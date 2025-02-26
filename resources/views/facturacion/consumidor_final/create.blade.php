@extends('menu')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.min.css') }}">
    <style>
        .input-group {
            display: flex;
            align-items: center;
        }

        .select-container {
            flex-grow: 1;
        }

        .select2-container {
            width: 100% !important;
            /* Asegura que select2 ocupe todo el ancho disponible */
        }

        button {
            margin-left: 10px;
            /* Ajusta el espacio entre el botón y el select */
        }
    </style>


    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        Consumidor final
                    </div>
                    <div class="prism-toggle">
                        <a href="{{ url('consumidor_final') }}"> <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z" />
                                </svg>
                            </button></a>
                    </div>
                </div>
                <form action="{{ route('consumidor_final.store') }}" method="POST">
                    @csrf
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



                        <div class="row gy-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Fecha:</p>
                                <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}"
                                    required>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Cliente:</p>
                                <div class="input-group">
                                    <div class="select-container">
                                        <select class="form-select select2" name="cliente_id"
                                            onchange="fetchClienteData(this.value)" required>
                                            <option value="">Seleccione</option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}">{{ $cliente->numero_documento }} -
                                                    {{ $cliente->razon_social }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="button"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                        </svg></button>
                                </div>



                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Dirección:</p>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Teléfono:</p>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Correo:</p>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>




                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Forma de Pago:</p>
                                <select class="form-select" name="forma_pago_id" required>
                                    @foreach ($formasPago as $formaPago)
                                        <option value="{{ $formaPago->id }}">{{ $formaPago->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('.select2').select2()
            // Llamar a la función para expandir el menú y resaltar la opción Producto
            expandMenuAndHighlightOption('facturacionMenu', 'consumidor_final_Option');

        });
    </script>

    <script>
        function fetchClienteData(clienteId) {
            if (clienteId) {
                fetch(`{{ url('cliente') }}/${clienteId}`)
                    .then(response => response.json())
                    .then(data => {
                        //console.log(data);
                        if (data) {
                            // Pintar los datos del cliente en los campos correspondientes
                            document.getElementById('direccion').value = data.direccion || ''; // Dirección
                            document.getElementById('telefono').value = data.telefono || ''; // Teléfono
                            document.getElementById('correo').value = data.correo || ''; // Correo
                        }
                    })
                    .catch(error => {
                        console.error('Error al realizar la solicitud:', error);
                    });
            }
        }
    </script>

@endsection
