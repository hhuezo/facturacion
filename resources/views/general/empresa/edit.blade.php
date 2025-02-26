@extends('menu')
@section('contenido')
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.min.css') }}">
    <br><br><br><br>
    <div class="row">
        <div class="col-xl-12">
            <div class="row profile-content">
                <div class="col-xl-3">
                    <div class="card custom-card overflow-hidden border">
                        <div class="card-body border-bottom border-block-end-dashed">
                            <div class="text-center">
                                <span class="avatar avatar-xxl avatar-rounded online mb-3">
                                    <img src="{{ asset('assets/images/faces/11.jpg') }}" alt="">
                                </span>
                                <h5 class="fw-semibold mb-1">{{ $empresa->razon_social }}</h5>
                                <span class="d-block fw-medium text-muted mb-2">{{ $empresa->nombre_comercial }}</span>
                            </div>
                        </div>

                        <div class="p-3 pb-1 d-flex flex-wrap justify-content-between">
                            <div class="fw-medium fs-15 text-primary1">
                                Información básica :
                            </div>
                        </div>
                        <div class="card-body border-bottom border-block-end-dashed p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item pt-2 border-0">
                                    <div><span class="fw-medium me-2">NIT :</span><span
                                            class="text-muted">{{ $empresa->nit }}</span></div>
                                </li>
                                <li class="list-group-item pt-2 border-0">
                                    <div><span class="fw-medium me-2">Dirección :</span><span
                                            class="text-muted">{{ $empresa->direccion }}</span></div>
                                </li>
                                <li class="list-group-item pt-2 border-0">
                                    <div><span class="fw-medium me-2">Correo :</span><span
                                            class="text-muted">{{ $empresa->correo }}</span></div>
                                </li>
                                <li class="list-group-item pt-2 border-0">
                                    <div><span class="fw-medium me-2">Teléfono :</span><span
                                            class="text-muted">{{ $empresa->telefono }}</span></div>
                                </li>
                                <li class="list-group-item pt-2 border-0">
                                    <div><span class="fw-medium me-2">NCR :</span><span
                                            class="text-muted">{{ $empresa->ncr }}</span></div>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card custom-card overflow-hidden border">

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


                                <div class="row gy-4">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="input-label" class="form-label">Razón social:</label>
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
                                        <input type="text" class="form-control" name="nit"
                                            value="{{ $empresa->nit }}" required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="input-label" class="form-label">Dirección:</label>
                                        <input type="text" class="form-control" name="direccion"
                                            value="{{ $empresa->direccion }}" required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="input-label" class="form-label">Correo:</label>
                                        <input type="text" class="form-control" name="correo"
                                            value="{{ $empresa->correo }}" required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="input-label" class="form-label">Teléfono:</label>
                                        <input type="text" class="form-control" name="telefono"
                                            value="{{ $empresa->telefono }}" required>
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
                                        <label for="input-label" class="form-label">Tipo negocio:</label>
                                        <select name="tipo_negocio_id" class="form-select select2" required>
                                            <option value="">SELECCIONE</option>
                                            @foreach ($tipos_negocio as $tipo)
                                                <option value="{{ $tipo->id }}"
                                                    {{ $tipo->id == $empresa->tipo_negocio_id ? 'selected' : '' }}>
                                                    {{ $tipo->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="input-label" class="form-label">Tipo producto:</label>
                                        <select name="tipo_producto_id" class="form-select" required>
                                            <option value="">SELECCIONE</option>
                                            @foreach ($tipos_producto as $tipo)
                                                <option value="{{ $tipo->id }}"
                                                    {{ $tipo->id == $empresa->tipo_producto_id ? 'selected' : '' }}>
                                                    {{ $tipo->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="input-label" class="form-label">NRC:</label>
                                        <input type="text" class="form-control" name="nrc"
                                            value="{{ $empresa->nrc }}" required>
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
                </div>
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

        });
    </script>
@endsection
