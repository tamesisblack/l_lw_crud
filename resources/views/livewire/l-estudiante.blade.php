<div>
    <div>
        <button class="btn btn-primary" wire:click="openModal">Agregar Estudiante</button>
        <h2>Lista de Estudiantes del Curso {{ $cursoId }}</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantes as $index => $estudiante)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $estudiante->nombres }}</td>
                        <td>{{ $estudiante->direccion }}</td>
                        <td>{{ $estudiante->edad }}</td>
                        <td>
                            <!-- Botón para abrir el modal de editar -->
                            <button class="btn btn-primary" wire:click="openEditarModal({{ $estudiante->id }})">Editar</button>
                            <!-- Botón para eliminar un estudiante con livewire -->
                            <button class="btn btn-danger" wire:click="eliminar({{ $estudiante->id }})">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de editar -->
    <div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="openModallLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="openModallLabel">Editar Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí colocarás los campos para editar el estudiante -->
                    <form wire:submit.prevent="actualizar">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" wire:model.defer="nombre">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" wire:model.defer="direccion">
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad</label>
                            <input type="text" class="form-control" id="edad" wire:model.defer="edad">
                        </div>
                        <input type="hidden" wire:model="estudianteId">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('openModal', () => {
            $('#openModal').modal('show');
        });
        // Cerrar el modal
        Livewire.on('cerrarModal', () => {
            $('#openModal').modal('hide');
            // Limpia los campos del formulario después de cerrar el modal
            $('#openModal').find('form')[0].reset();
        });
    });

</script>