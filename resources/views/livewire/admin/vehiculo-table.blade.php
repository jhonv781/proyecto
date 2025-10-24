<div class="w-full py-8 px-4 sm:px-6 lg:px-8" x-data="vehicleTable()">
    {{-- Manejo de mensajes de éxito (Laravel session) --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "{{ session('success') }}",
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#22c55e',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-lg shadow-lg'
                }
            });
        </script>
    @endif

    {{-- Manejo de errores de validación (Laravel errors) --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#ef4444',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-lg shadow-lg text-left'
                }
            });
        </script>
    @endif

    <div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800">
        <div class="flex justify-between items-center mb-6">
            {{-- Título de la lista actualizado --}}
            <h1 class="text-2xl font-bold text-white" data-flux-component="heading">
                Lista de Vehículos en Garaje 🚗
            </h1>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">#</th>
                        {{-- Cabeceras de columna actualizadas --}}
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Marca</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Modelo</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Año</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Color</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-zinc-300 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    {{-- La variable de iteración se ha renombrado de $restaurantes a $vehiculos (asumiendo el cambio en el controlador) --}}
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $loop->iteration }}</td>
                            {{-- Contenido de las celdas actualizado (asumiendo $vehiculo tiene los atributos: marca, modelo, anio, color) --}}
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $vehiculo->marca }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $vehiculo->modelo ? Str::limit($vehiculo->modelo, 50) : 'N/A' }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $vehiculo->anio }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $vehiculo->color }}</td>
                            <td class="px-4 py-4 text-sm text-right">
                                {{-- Botón de edición: parámetros actualizados al nuevo esquema --}}
                                <button
                                    @click="openModal({{ $vehiculo->id }}, '{{ addslashes($vehiculo->marca) }}', '{{ addslashes($vehiculo->modelo ?? '') }}', {{ $vehiculo->anio }}, '{{ addslashes($vehiculo->color ?? '') }}')"
                                    class="text-blue-500 hover:text-blue-400 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>

                                {{-- Botón de eliminación --}}
                                <button onclick="confirmDelete({{ $vehiculo->id }})"
                                    class="text-red-500 hover:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <form id="delete-form-{{ $vehiculo->id }}"
                                    action="{{ route('admin.vehiculo.destroy', $vehiculo->id) }}" method="POST"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación (si aplica) --}}
        @if ($vehiculos->hasPages())
            <div class="mt-6">
                {{ $vehiculos->links() }}
            </div>
        @endif
    </div>

    {{-- Modal de Edición (Alpine.js x-teleport) --}}
    <template x-teleport="body">
        <div x-show="isOpen" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-black opacity-75" @click="closeModal"></div>
                </div>

                <div
                    class="inline-block align-bottom bg-zinc-900 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-zinc-800">
                    {{-- Ruta de acción del formulario actualizada a 'admin.vehiculo.update' --}}
                    <form :action="'/admin/vehiculo/' + currentId" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="px-8 py-8">
                            <h3 class="text-xl font-semibold text-white mb-6">Editar Vehículo</h3>

                            {{-- Campo Marca --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Marca</label>
                                <input type="text" x-model="currentMarca" name="marca"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            {{-- Campo Modelo --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Modelo</label>
                                <input x-model="currentModelo" name="modelo"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></input>
                            </div>

                            {{-- Campo Año --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Año</label>
                                <input type="number" x-model="currentAnio" name="anio" step="1" min="1900" max="2099"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            {{-- Campo Color --}}
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Color</label>
                                <input type="text" x-model="currentColor" name="color"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="px-8 py-4 bg-zinc-800 flex justify-end space-x-4">
                            <button type="button" @click="closeModal" class="px-6 py-3 text-zinc-300 hover:text-white">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
    // Función para confirmar eliminación
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar vehículo?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            background: '#18181b',
            color: '#f4f4f5',
            iconColor: '#ef4444',
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'rounded-lg shadow-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Se asume que la ruta ahora es 'delete-form-' + id
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Componente Alpine.js para la tabla
    function vehicleTable() {
        return {
            isOpen: false,
            currentId: null,
            // Variables del modal actualizadas
            currentMarca: '',
            currentModelo: '',
            currentAnio: 0,
            currentColor: '',

            // Función openModal con nuevos parámetros
            openModal(id, marca, modelo, anio, color) {
                this.currentId = id;
                this.currentMarca = marca;
                this.currentModelo = modelo;
                this.currentAnio = anio;
                this.currentColor = color;
                this.isOpen = true;
                document.body.classList.add('overflow-hidden');
            },

            closeModal() {
                this.isOpen = false;
                document.body.classList.remove('overflow-hidden');
            }
        }
    }
</script>