<div class="modal fade" id="modal-edit-{{ $sucursal->id }}" tabindex="-1" aria-labelledby="exampleModalLgLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('sucursal.update', $sucursal->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLgLabel">Editar sucursal</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-4">
                        <!-- Código -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Código:</label>
                            <input type="text" class="form-control" name="codigo" value="{{ $sucursal->codigo }}" required>
                            <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id }}" required>
                        </div>

                        <!-- Responsable -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Responsable:</label>
                            <input type="text" class="form-control" name="responsable" value="{{ $sucursal->responsable }}">
                        </div>

                        <!-- Teléfono -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" value="{{ $sucursal->telefono }}">
                        </div>

                        <!-- Correo -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Correo:</label>
                            <input type="email" class="form-control" name="correo" value="{{ $sucursal->correo }}" required>
                        </div>

                        <!-- Departamento -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Departamento:</label>
                            <select name="mh_departamento_id" id="mh_departamento_id_{{ $sucursal->id }}" class="form-select" required>
                                <option value="">SELECCIONE</option>
                                @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}"
                                        {{ $sucursal->mh_departamento_id == $departamento->id ? 'selected' : '' }}>
                                        {{ $departamento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Municipio -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Municipio:</label>
                            <select name="mh_municipio_id" id="mh_municipio_id_{{ $sucursal->id }}" class="form-select" required>
                                <option value="">SELECCIONE</option>
                                @foreach ($sucursal->departamento->municipios as $municipio)
                                    <option value="{{ $municipio->id }}"
                                        {{ $sucursal->mh_municipio_id == $municipio->id ? 'selected' : '' }}>
                                        {{ $municipio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dirección -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="input-label" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" name="direccion" value="{{ $sucursal->direccion }}" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
