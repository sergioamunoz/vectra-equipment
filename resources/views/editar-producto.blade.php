<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VECTRA | Editar Producto</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white antialiased p-10">
    <div class="max-w-2xl mx-auto space-y-8">
        <!-- Cabecera -->
        <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
            <div>
                <h1 class="text-2xl font-black uppercase tracking-wider">Editar Producto #{{ $producto->id }}</h1>
                <p class="text-zinc-400 text-sm mt-1">Modifica los campos que desees actualizar.</p>
            </div>
            <a href="{{ url('/inventario') }}" class="bg-zinc-800 text-white font-bold px-4 py-2 text-xs uppercase tracking-widest hover:bg-zinc-700 transition-colors">
                Cancelar
            </a>
        </div>

        <!-- FORMULARIO DE EDICIÓN -->
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg p-6 space-y-4">
            @if ($errors->any())
                <div class="bg-red-950 border border-red-900 text-red-400 p-4 rounded text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/inventario/actualizar/' . $producto->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Nombre del Producto</label>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-white focus:outline-none focus:border-white">
                </div>

                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Precio (€)</label>
                    <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-white focus:outline-none focus:border-white">
                </div>

                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Stock (Unidades)</label>
                    <input type="number" name="stock" value="{{ $producto->stock }}" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-white focus:outline-none focus:border-white">
                </div>

                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Descripción</label>
                    <textarea name="descripcion" rows="3" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-white focus:outline-none focus:border-white">{{ $producto->descripcion }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-white text-black font-bold py-3 px-4 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">
                        Actualizar Producto en Base de Datos
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>