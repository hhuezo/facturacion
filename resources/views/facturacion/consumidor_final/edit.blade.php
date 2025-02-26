@extends('menu')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.min.css') }}">

    <style>
        /* Para navegadores WebKit (Chrome, Safari, Edge) */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Para Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
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
                                <input type="date" class="form-control" name="fecha"
                                    value="{{ old('fecha', $consumidorFinal->fecha) }}" required>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Cliente:</p>
                                <div class="input-group">
                                    <select class="form-select select2" name="cliente_id" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}"
                                                {{ old('cliente_id', $consumidorFinal->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->numero_documento }} - {{ $cliente->razon_social }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Dirección:</p>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    value="{{ old('direccion', $consumidorFinal->direccion) }}">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Teléfono:</p>
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    value="{{ old('telefono', $consumidorFinal->telefono) }}">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Correo:</p>
                                <input type="email" class="form-control" id="correo" name="correo" required
                                    value="{{ old('correo', $consumidorFinal->correo) }}">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Forma de Pago:</p>
                                <select class="form-select" name="forma_pago_id" required>
                                    @foreach ($formasPago as $formaPago)
                                        <option value="{{ $formaPago->id }}"
                                            {{ old('forma_pago_id', $consumidorFinal->forma_pago_id) == $formaPago->id ? 'selected' : '' }}>
                                            {{ $formaPago->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>





                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio unitario</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Impuesto</th>
                                    <th scope="col">Descuento %</th>
                                    <th scope="col">Unitario IVA</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Guardar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-select select2" name="producto_id" id="producto_id"
                                            onchange="fetchProdutoeData(this.value)">
                                            <option value="">Seleccione</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}">
                                                    {{ $producto->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" class="form-control" name="precio_unitario"
                                            id="precio_unitario" min="0" step="0.01"></td>
                                    <td><input type="number" class="form-control" name="cantidad" id="cantidad"
                                            onchange="calculosTotales()" min="1" step="1"></td>
                                    <td><input type="number" class="form-control" name="impuesto" id="impuesto"
                                            min="0" step="0.01"></td>

                                    <td><input type="number" class="form-control" name="descuento" id="descuento"
                                            min="0" max="100" step="0.01"></td>
                                    <td><input type="number" class="form-control" name="unitario_iva" id="unitario_iva"
                                            min="0" step="0.01" readonly></td>
                                    <td><input type="number" class="form-control" name="total" id="total"
                                            min="0" step="0.01" readonly></td>

                                    <td> <button class="btn btn-info" type="button"> <svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-floppy2-fill" viewBox="0 0 16 16">
                                                <path d="M12 2h-2v3h2z" />
                                                <path
                                                    d="M1.5 0A1.5 1.5 0 0 0 0 1.5v13A1.5 1.5 0 0 0 1.5 16h13a1.5 1.5 0 0 0 1.5-1.5V2.914a1.5 1.5 0 0 0-.44-1.06L14.147.439A1.5 1.5 0 0 0 13.086 0zM4 6a1 1 0 0 1-1-1V1h10v4a1 1 0 0 1-1 1zM3 9h10a1 1 0 0 1 1 1v5H2v-5a1 1 0 0 1 1-1" />
                                            </svg></button></td>
                                </tr>

                                <tr>
                                    <td colspan="7">
                                        <center>
                                            <button class="btn btn-success"> <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                                </svg></button>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <input type="text" class="form-control" name="tipo_iva_id" id="tipo_iva_id" min="0"
                            step="0.01">

                    </div>


                    {{--
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div> --}}
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
        function fetchProdutoeData(id) {
            if (!id) return;

            fetch(`{{ url('producto') }}/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Producto consultado:", data.data);
                        if (data.data) {
                            // Pintar los datos del cliente en los campos correspondientes
                            let precio = parseFloat(data.data.precio); // Convierte a número eliminando ceros extra
                            let precioFormateado = precio.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 14
                            });

                            document.getElementById('precio_unitario').value = precioFormateado;
                            document.getElementById('tipo_iva_id').value = data.data.tipo_iva_id;

                            calculosTotales();
                        }
                    } else {
                        console.error("Error:", data.message);
                    }
                })
                .catch(error => console.error("Error en la petición:", error));
        }


        function calculosTotales() {
            let cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
            let precio_unitario = parseFloat(document.getElementById('precio_unitario').value) || 0;
            let tipo_iva_id = document.getElementById('tipo_iva_id').value;

            let subtotal = cantidad * precio_unitario;
            let unitario_iva = tipo_iva_id == 1 ? subtotal * 0.13 : 0;

            document.getElementById('unitario_iva').value = unitario_iva.toFixed(2);
            document.getElementById('total').value = (subtotal + unitario_iva).toFixed(2);
        }
    </script>

@endsection
