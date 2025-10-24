
<div class="w-full py-8 px-4 sm:px-6 lg:px-8" x-data="productTable()">
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
            <h1 class="text-2xl font-bold text-white" data-flux-component="heading">
                Lista de Productos
            </h1>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Nombre</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Descripción</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Precio</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Categoría</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-zinc-300 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $product->nombre }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $product->descripcion ? Str::limit($product->descripcion, 50) : 'Sin descripción' }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ number_format($product->precio, 2) }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $product->categoria }}</td>
                            <td class="px-4 py-4 text-sm text-right">
                                <button
                                    @click="openModal({{ $product->id }}, '{{ addslashes($product->nombre) }}', '{{ addslashes($product->descripcion ?? '') }}', {{ $product->precio }}mjnnnnn,'{{ addslashes($product->categoria ?? '') }}')"
                                    class="text-blue-500 hover:text-blue-400 mr-3 inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>

                                <button onclick="confirmDelete({{ $product->id }})"
                                    class="text-red-500 hover:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <form id="delete-form-{{ $product->id }}"
                                    action="{{ route('admin.producto.destroy', $product->id) }}" method="POST"
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

        @if ($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- MODAL DE EDICIÓN -->
    <div x-show="isOpen" 
         x-cloak 
         @keydown.escape.window="closeModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 overflow-y-auto"
         style="z-index: 9999; display: none;">

        <div class="flex items-center justify-center min-h-screen px-4 py-6">
            <!-- Fondo oscuro -->
            <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" 
                 aria-hidden="true"
                 @click="closeModal"
                 style="z-index: 9998;"></div>

            <!-- Contenido del Modal -->
            <div
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                class="relative bg-zinc-900 rounded-xl shadow-2xl w-full max-w-2xl border border-zinc-700"
                style="z-index: 9999;"
                @click.stop
>
                
                <form :action="'/admin/producto/' + currentId" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Header del Modal -->
                    <div class="px-6 py-5 border-b border-zinc-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-white">Editar Producto</h3>
                            <button type="button" 
                                    @click="closeModal"
                                    class="text-zinc-400 hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Body del Modal -->
                    <div class="px-6 py-6 space-y-5">
                        <!-- Campo Nombre -->
                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-2">
                                Nombre del Producto <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   x-model="currentName" 
                                   name="nombre"
                                   class="w-full px-4 py-3 bg-zinc-800 border border-zinc-600 rounded-lg text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   placeholder="Ej: Paracetamol"
                                   required>
                        </div>

                        <!-- Campo Descripción -->
                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-2">
                                Descripción
                            </label>
                            <textarea x-model="currentDescription" 
                                      name="descripcion" 
                                      rows="4"
                                      class="w-full px-4 py-3 bg-zinc-800 border border-zinc-600 rounded-lg text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                                      placeholder="Describe las características del producto..."></textarea>
                        </div>

                        <!-- Campo Precio -->
                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-2">
                                Precio (S/.) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   x-model="currentPrice" 
                                   name="precio" 
                                   step="0.01" 
                                   min="0"
                                   class="w-full px-4 py-3 bg-zinc-800 border border-zinc-600 rounded-lg text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   placeholder="0.00"
                                   required>
                        </div>
                        <!-- Campo Categoria -->
                        <div>
                            <label class="block text-sm font-medium text-zinc-300 mb-2">
                                Nombre de categoria <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   x-model="currentCategori" 
                                   name="categoria"
                                   class="w-full px-4 py-3 bg-zinc-800 border border-zinc-600 rounded-lg text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   placeholder="EJ:medicina"
                                   required>
                        </div>
                    </div>

                    <!-- Footer del Modal -->
                    <div class="px-6 py-4 bg-zinc-800/50 border-t border-zinc-700 flex justify-end gap-3">
                        <button type="button" 
                                @click="closeModal" 
                                class="px-5 py-2.5 text-sm font-medium text-zinc-300 hover:text-white bg-zinc-700 hover:bg-zinc-600 rounded-lg transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-lg shadow-blue-500/20">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Confirmar eliminación
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar producto?',
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
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Alpine.js component
    function productTable() {
        return {
            isOpen: false,
            currentId: null,
            currentName: '',
            currentDescription: '',
            currentCategori: '',
            currentPrice: 0,

            openModal(id, nombre, descripcion, precio, categoria) {
                this.currentId = id;
                this.currentName = nombre;
                this.currentDescription = descripcion;
                this.currentPrice = precio;
                this.currentCategori = categoria,
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
