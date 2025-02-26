<div class="modal fade" id="modal-delete-{{ $producto->id }}" tabindex="-1" aria-labelledby="exampleModalLgLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLgLabel">Eliminar Producto</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('producto.destroy', $producto->id) }}">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <label for="confirmacion">¿Estás seguro de que deseas eliminar este producto?</label>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </div>

        </form>
    </div>
</div>
