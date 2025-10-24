<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="w-full py-8 px-4 sm:px-6 lg:px-8">
    
    {{-- Alerta de Éxito: Se muestra si hay un mensaje 'success' en la sesión --}}
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
                    popup: 'rounded-xl shadow-lg'
                }
            });
        </script>
    @endif

    {{-- Alerta de Error: Se muestra si hay errores de validación --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error de Validación',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#ef4444',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-xl shadow-lg text-left'
                }
            });
        </script>
    @endif

    <div class="max-w-3xl mx-auto bg-zinc-900 rounded-2xl shadow-3xl overflow-hidden p-8 border border-zinc-800">
        <h1 class="text-3xl font-extrabold text-amber-400 mb-8 border-b border-zinc-700 pb-4" data-flux-component="heading">
            Registrar Nuevo Plato al Menú
        </h1>
        
        <form action="{{ route('admin.restaurante.store') }}" method="POST" class="space-y-6" data-flux-component="form">
            @csrf
            
            <div data-flux-field>
                <label for="nombre" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Nombre del Plato <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nombre" name="nombre"
                    value="{{ old('nombre') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Lomo Saltado, Pasta Carbonara" required data-flux-control>
                @error('nombre')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>

            <div data-flux-field>
                <label for="categoria" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Categoría <span class="text-red-500">*</span>
                </label>
                <input type="text" id="categoria" name="categoria"
                    value="{{ old('categoria') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Entradas, Postres, Platos Fuertes" required data-flux-control>
                @error('categoria')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            
            <div data-flux-field>
                <label for="descripcion" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Descripción Detallada
                </label>
                <textarea id="descripcion" name="descripcion" rows="3"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Describe los ingredientes, alérgenos y detalles de presentación.">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            
            <div data-flux-field>
                <label for="precio" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Precio ($) <span class="text-red-500">*</span>
                </label>
                <input type="number" id="precio" name="precio" step="0.01" min="0.01"
                    value="{{ old('precio') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: 15.99" required data-flux-control>
                @error('precio')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="relative my-8 pt-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-800"></div>
                </div>
            </div>
            
            <div class="text-sm text-zinc-500 mb-6 text-right">
                Campos marcados con <span class="text-red-500 font-bold">*</span> son obligatorios
            </div>
            
            <div class="flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-amber-600 text-white font-bold rounded-xl hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-[1.02]"
                    data-flux-component="button">
                    Añadir Plato al Menú
                </button>
            </div>
        </form>
    </div>
</div>