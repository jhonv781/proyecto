<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Estilo para un mejor contraste en fondo oscuro, si es necesario */
        .shadow-3xl {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
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
        
        <h1 class="text-3xl font-extrabold text-blue-400 mb-8 border-b border-zinc-700 pb-4" data-flux-component="heading">
            Registrar Ingreso de Vehículo 🚗
        </h1>

        {{-- Ruta y campos del formulario actualizados --}}
        <form action="{{ route('admin.vehiculo.store') }}" method="POST" class="space-y-6" data-flux-component="form">
            @csrf

            {{-- Campo Marca --}}
            <div data-flux-field>
                <label for="marca" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Marca del Vehículo <span class="text-red-500">*</span>
                </label>
                <input type="text" id="marca" name="marca"
                    value="{{ old('marca') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Toyota, BMW, Honda" required data-flux-control>
                @error('marca')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Modelo --}}
            <div data-flux-field>
                <label for="modelo" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Modelo <span class="text-red-500">*</span>
                </label>
                <input type="text" id="modelo" name="modelo"
                    value="{{ old('modelo') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Corolla, F-150, CBR 500R" required data-flux-control>
                @error('modelo')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Color --}}
            <div data-flux-field>
                <label for="color" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Color del Vehículo
                </label>
                <input type="text" id="color" name="color"
                    value="{{ old('color') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Negro, Blanco, Rojo" data-flux-control>
                @error('color')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Campo Año --}}
            <div data-flux-field>
                <label for="anio" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Año de Fabricación <span class="text-red-500">*</span>
                </label>
                <input type="number" id="anio" name="anio" step="1" min="1900" max="2024"
                    value="{{ old('anio') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: 2021" required data-flux-control>
                @error('anio')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Tiempo de Estadía (Opcional, para el registro inicial) --}}
            <div data-flux-field>
                <label for="estadia_horas" class="block text-sm font-semibold text-zinc-300 mb-1" data-flux-label>
                    Estadía Inicial (horas)
                </label>
                <input type="number" id="estadia_horas" name="estadia_horas" min="1"
                    value="{{ old('estadia_horas') }}"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: 5 (horas)" data-flux-control>
                @error('estadia_horas')
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
                    class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-[1.02]"
                    data-flux-component="button">
                    Registrar Entrada al Garaje
                </button>
            </div>
        </form>
    </div>
</div>