<div class="modal fade" id="modal-edit-{{ $cliente->id }}" tabindex="-1" aria-labelledby="exampleModalLgLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLgLabel">Editar Cliente</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('cliente.update', $cliente->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row gy-4">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Razón social:</label>
                            <input type="text" class="form-control" name="razon_social"
                                value="{{ $cliente->razon_social }}" required>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Nombre comercial:</label>
                            <input type="text" class="form-control" name="nombre_comercial"
                                value="{{ $cliente->nombre_comercial }}">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Tipo identificación:</label>
                            <select name="tipo_identificacion_id" class="form-select" required>
                                <option value="">SELECCIONE</option>
                                @foreach ($tipos_identificacion as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $cliente->tipo_identificacion_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Número de documento:</label>
                            <input type="text" class="form-control" name="numero_documento"
                                value="{{ $cliente->numero_documento }}" required>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">NRC:</label>
                            <input type="text" class="form-control" name="nrc" value="{{ $cliente->nrc }}">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Género:</label>
                            <select name="genero" class="form-select">
                                <option value="">SELECCIONE</option>
                                <option value="1" {{ $cliente->genero == 1 ? 'selected' : '' }}>Masculino</option>
                                <option value="2" {{ $cliente->genero == 2 ? 'selected' : '' }}>Femenino</option>
                                <option value="3" {{ $cliente->genero == 3 ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Ciudad:</label>
                            <input type="text" class="form-control" name="ciudad" value="{{ $cliente->ciudad }}">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" name="direccion"
                                value="{{ $cliente->direccion }}" required>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Compañia telefónica:</label>
                            <select name="operadora_telefono_id" class="form-select">
                                <option value="">SELECCIONE</option>
                                @foreach ($operadores_telefono as $operador)
                                    <option value="{{ $operador->id }}"
                                        {{ $cliente->operadora_telefono_id == $operador->id ? 'selected' : '' }}>
                                        {{ $operador->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" value="{{ $cliente->telefono }}"
                                required>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Correo:</label>
                            <input type="email" class="form-control" name="correo" value="{{ $cliente->correo }}"
                                required>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Tipo contribuyente:</label>
                            <select name="tipo_contribuyente_id" class="form-select" required>
                                <option value="">SELECCIONE</option>
                                @foreach ($tipos_contribuyente as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $cliente->tipo_contribuyente_id == $tipo->id ? 'selected' : '' }}>
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
                                        {{ $cliente->tipo_cliente_id == $tipo->id ? 'selected' : '' }}>
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
