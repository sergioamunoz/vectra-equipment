<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VECTRA | Inventario</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white antialiased p-10">
    <div class="max-w-6xl mx-auto space-y-8">
        <!-- Cabecera -->
        <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
            <div>
                <h1 class="text-3xl font-black uppercase tracking-wider">Panel de Inventario VECTRA</h1>
                <p class="text-zinc-400 text-sm mt-1">Gestión de stock conectada directamente a la base de datos.</p>
            </div>
            <a href="{{ url('/') }}" class="bg-white text-black font-bold px-4 py-2 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors">
                Volver a Portada
            </a>
        </div>

        <!-- FORMULARIO PARA AÑADIR PRODUCTO -->
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg p-6 space-y-4">
            <h2 class="text-lg font-bold uppercase tracking-wider text-zinc-200 border-b border-zinc-900 pb-2">
                Añadir Nuevo Equipo Deportivo
            </h2>

            <!-- Errores de validación -->
            @if ($errors->any())
                <div class="bg-red-950 border border-red-900 text-red-400 p-4 rounded text-xs">
                    <p class="font-bold mb-1">¡Revisa los datos! Hay errores en el formulario:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mensaje de éxito verde -->
            @if (session('exito'))
                <div class="bg-emerald-950 border border-emerald-900 text-emerald-400 p-4 rounded-lg text-xs font-bold flex items-center justify-between">
                    <span>{{ session('exito') }}</span>
                </div>
            @endif

            <form action="{{ url('/inventario/guardar') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Nombre del Producto</label>
                    <input type="text" name="nombre" placeholder="Ej. Rodilleras SCR" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-white focus:outline-none focus:border-white">
                </div>
                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Precio (€)</label>
                    <input type="number" step="0.01" name="precio" placeholder="29.99" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-white focus:outline-none focus:border-white">
                </div>
                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Stock (Unidades)</label>
                    <input type="number" name="stock" placeholder="15" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-white focus:outline-none focus:border-white">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-white text-black font-bold py-2 px-4 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">
                        Guardar en Base de Datos
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabla de Productos -->
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-900 border-b border-zinc-800 text-xs font-mono text-zinc-400 uppercase tracking-widest">
                        <th class="p-4">ID</th>
                        <th class="p-4">Nombre del Equipo</th>
                        <th class="p-4">Precio</th>
                        <th class="p-4">Stock</th>
                        <th class="p-4">Descripción</th>
                        <th class="p-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900 text-sm">
                    @forelse($productos as $producto)
                        <tr class="hover:bg-zinc-900/50 transition-colors">
                            <td class="p-4 font-mono text-zinc-500">#{{ $producto->id }}</td>
                            <td class="p-4 font-bold uppercase text-white">{{ $producto->nombre }}</td>
                            <td class="p-4 text-zinc-300">{{ $producto->precio }} €</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded text-xs font-bold {{ $producto->stock > 0 ? 'bg-zinc-800 text-white border border-zinc-700' : 'bg-red-950 text-red-400 border border-red-900' }}">
                                    {{ $producto->stock }} unidades
                                </span>
                            </td>
                            <td class="p-4 text-zinc-400 text-xs">{{ $producto->descripcion ?? 'Sin descripción' }}</td>
                            
                            <!-- ACCIONES: EDITAR Y ELIMINAR -->
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ url('/inventario/editar/' . $producto->id) }}" class="bg-zinc-800 text-white border border-zinc-700 px-3 py-1 rounded text-xs font-bold uppercase tracking-wider hover:bg-zinc-700 transition-colors">
                                        Editar
                                    </a>
                                    <form action="{{ url('/inventario/eliminar/' . $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-950 text-red-400 border border-red-900 px-3 py-1 rounded text-xs font-bold uppercase tracking-wider hover:bg-red-900 transition-colors">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-zinc-500 italic">
                                No hay productos registrados todavía en la base de datos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>