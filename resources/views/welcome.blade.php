<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VECTRA | Official Store</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Iconos Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-ticker {
            display: inline-block;
            white-space: nowrap;
            animation: ticker 20s linear infinite;
        }
    </style>
</head>
<body class="bg-black text-white antialiased selection:bg-white selection:text-black relative">

    <!-- 1. BARRA SUPERIOR (ANUNCIOS DESLIZANTES) -->
    <div class="bg-zinc-950 border-b border-zinc-800 text-xs py-2 px-4 flex justify-between items-center overflow-hidden relative z-50">
        <div class="w-24 hidden md:block"></div>
        <div class="flex-1 overflow-hidden relative mx-4 text-center">
            <div class="animate-ticker text-zinc-300 font-semibold tracking-widest uppercase">
                @foreach($anuncios as $anuncio)
                    <span class="mx-8">{{ $anuncio }}</span>
                @endforeach
            </div>
        </div>
        <div class="w-24 text-right">
            <select class="bg-transparent text-zinc-400 font-bold uppercase text-[11px] border border-zinc-800 rounded px-1.5 py-0.5 focus:outline-none hover:text-white cursor-pointer">
                <option value="es" class="bg-black text-white">ES</option>
                <option value="en" class="bg-black text-white">EN</option>
            </select>
        </div>
    </div>

    <!-- 2. HEADER FIJO -->
    <header class="sticky top-0 bg-black/85 backdrop-blur-md border-b border-zinc-900 z-40 px-6 py-4 flex justify-between items-center">
        <!-- Izquierda: Menú + Lupa -->
        <div class="flex items-center gap-5">
            <button onclick="toggleMenu()" class="hover:text-zinc-400 transition-colors" title="Opciones">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <button onclick="toggleSearchModal()" class="hover:text-zinc-400 transition-colors" title="Buscar">
                <i data-lucide="search" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Centro: Logo VECTRA -->
        <div class="text-center">
            <a href="{{ url('/') }}" class="text-2xl md:text-3xl font-black tracking-tighter uppercase border-2 border-white px-2 py-0.5 inline-block">
                VECTRA
            </a>
        </div>

        <!-- Derecha: Usuario + Carrito -->
        <div class="flex items-center gap-5">
            <button onclick="toggleUserModal()" class="hover:text-zinc-400 transition-colors" title="Mi Cuenta">
                <i data-lucide="user" class="w-6 h-6"></i>
            </button>
            <button onclick="toggleCartDrawer()" class="hover:text-zinc-400 transition-colors relative" title="Carrito">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                <span class="absolute -top-1.5 -right-2 bg-white text-black text-[10px] font-black rounded-full w-4 h-4 flex items-center justify-center">0</span>
            </button>
        </div>
    </header>

    <!-- MENÚ LATERAL DESPLEGABLE CON MODALES INDEPENDIENTES -->
    <div id="sideMenu" class="fixed inset-0 bg-black/90 backdrop-blur-lg z-50 transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between p-8 max-w-md w-full border-r border-zinc-800">
        <div>
            <div class="flex justify-between items-center mb-10">
                <span class="text-2xl font-black tracking-widest uppercase">Navegación</span>
                <button onclick="toggleMenu()" class="text-zinc-400 hover:text-white">
                    <i data-lucide="x" class="w-8 h-8"></i>
                </button>
            </div>
            <nav class="space-y-6">
                <div>
                    <span class="text-xs font-mono text-zinc-500 uppercase tracking-widest block mb-2">Secciones Principales</span>
                    <ul class="space-y-4 text-xl font-extrabold uppercase tracking-wide">
                        <li><a href="{{ url('/') }}" class="hover:text-zinc-400 transition-colors block">Inicio</a></li>
                        <li><a href="{{ url('/inventario') }}" class="hover:text-zinc-400 transition-colors block text-white underline decoration-2 underline-offset-4">Gestión Inventario (CRUD)</a></li>
                        <li><button onclick="toggleCatalogModal(); toggleMenu();" class="hover:text-zinc-400 transition-colors block text-left w-full">Catálogo de Fuerza</button></li>
                        <li><button onclick="toggleNewsModal(); toggleMenu();" class="hover:text-zinc-400 transition-colors block text-left w-full">Novedades 2026</button></li>
                        <li><button onclick="toggleSupportModal(); toggleMenu();" class="hover:text-zinc-400 transition-colors block text-left w-full">Soporte y Contacto</button></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="text-xs text-zinc-600 border-t border-zinc-900 pt-4">
            VECTRA STRENGTH EQUIPMENT © 2026
        </div>
    </div>

    <!-- 3. CARRUSEL HERO PRINCIPAL -->
    <section class="relative h-[85vh] w-full overflow-hidden bg-zinc-950">
        @foreach($carruselHero as $index => $slide)
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-index="{{ $index }}">
                <img src="{{ $slide['imagen'] }}" alt="{{ $slide['titulo'] }}" class="w-full h-full object-cover object-center filter brightness-50">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/60 flex items-center justify-center p-6">
                    <div class="text-center max-w-3xl space-y-4">
                        <span class="text-xs font-mono uppercase tracking-widest bg-white/10 text-zinc-300 px-3 py-1 rounded-full border border-white/20">
                            VECTRA High Performance Equipment
                        </span>
                        <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-white leading-tight">
                            {{ $slide['titulo'] }}
                        </h1>
                        <p class="text-zinc-300 text-sm md:text-lg max-w-xl mx-auto">
                            {{ $slide['subtitulo'] }}
                        </p>
                        <div class="pt-4">
                            <a href="{{ url('/inventario') }}" class="bg-white text-black font-black px-8 py-4 text-xs md:text-sm uppercase tracking-widest hover:bg-zinc-200 transition-colors inline-block">
                                Ver Inventario
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <!-- 4. FOOTER -->
    <footer class="bg-zinc-950 border-t border-zinc-900 pt-16 pb-12 px-6 text-xs text-zinc-400">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-zinc-900">
            <div class="space-y-3">
                <span class="text-xl font-black tracking-widest text-white uppercase block">VECTRA</span>
                <p class="text-zinc-500 text-xs">Equipamiento de alta resistencia para deportistas de fuerza.</p>
            </div>
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider mb-4">Datos de la Empresa</h4>
                <p class="text-zinc-500 leading-relaxed">
                    {{ $datosEmpresa['nombre'] }}<br>
                    CIF: {{ $datosEmpresa['cif'] }}<br>
                    {{ $datosEmpresa['direccion'] }}<br>
                    Email: {{ $datosEmpresa['email'] }}
                </p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto pt-8 text-center text-zinc-600">
            © 2026 {{ $datosEmpresa['nombre'] }}. Todos los derechos reservados.
        </div>
    </footer>

    <!-- MODAL CATÁLOGO DE FUERZA -->
    <div id="catalogModal" class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 hidden flex items-center justify-center px-4">
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg max-w-lg w-full p-6 space-y-6 relative">
            <div class="flex justify-between items-center border-b border-zinc-900 pb-3">
                <span class="text-lg font-black uppercase tracking-wider">Catálogo de Fuerza VECTRA</span>
                <button onclick="toggleCatalogModal()" class="text-zinc-400 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div class="space-y-3 text-xs text-zinc-300">
                <p class="text-zinc-400">Línea profesional diseñada para entrenamiento de hipertrofia y powerlifting:</p>
                <ul class="space-y-2 border-l-2 border-white pl-3 font-mono">
                    <li>• Jaulas de Potencia y Multi-Racks de acero reforzado.</li>
                    <li>• Discos Bumper de Alta Densidad (Calibración Olímpica).</li>
                    <li>• Barras Olímpicas de Acero al Carbono (Carga máx. 700kg).</li>
                    <li>• Bancos Regulables de Grado Comercial.</li>
                </ul>
                <div class="pt-2">
                    <button onclick="toggleCatalogModal();" class="w-full bg-white text-black font-bold py-3 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">
                        Cerrar Catálogo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL NOVEDADES 2026 -->
    <div id="newsModal" class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 hidden flex items-center justify-center px-4">
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg max-w-lg w-full p-6 space-y-6 relative">
            <div class="flex justify-between items-center border-b border-zinc-900 pb-3">
                <span class="text-lg font-black uppercase tracking-wider">Novedades Temporada 2026</span>
                <button onclick="toggleNewsModal()" class="text-zinc-400 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div class="space-y-3 text-xs text-zinc-300">
                <span class="inline-block bg-white text-black font-bold px-2 py-0.5 text-[10px] uppercase tracking-widest">Lanzamiento 2026</span>
                <p class="text-zinc-400">Últimas incorporaciones a nuestro catálogo de alta resistencia:</p>
                <ul class="space-y-2 border-l-2 border-white pl-3 font-mono">
                    <li>⚡ Agarres Neutros Ergonómicos para Jalón de Espalda.</li>
                    <li>⚡ Cinturones de Lastre Pro con Hebilla de Liberación Rápida.</li>
                    <li>⚡ Rodilleras de Neopreno SCR 7mm para Sentadilla Pesada.</li>
                </ul>
                <div class="pt-2">
                    <button onclick="toggleNewsModal();" class="w-full bg-white text-black font-bold py-3 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">
                        Cerrar Novedades
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE BÚSQUEDA RÁPIDA -->
    <div id="searchModal" class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 hidden flex items-start justify-center pt-28 px-4">
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg max-w-xl w-full p-6 space-y-4 relative">
            <div class="flex justify-between items-center border-b border-zinc-900 pb-3">
                <span class="text-xs font-mono uppercase tracking-widest text-zinc-400">Búsqueda Global VECTRA</span>
                <button onclick="toggleSearchModal()" class="text-zinc-400 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ url('/inventario') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" placeholder="Escribe el equipo que buscas..." class="w-full bg-zinc-900 border border-zinc-800 rounded p-3 text-sm text-white focus:outline-none focus:border-white">
                <button type="submit" class="bg-white text-black font-bold px-5 py-3 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">Ir</button>
            </form>
        </div>
    </div>

    <!-- MODAL DE USUARIO / LOGIN -->
    <div id="userModal" class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 hidden flex items-center justify-center px-4">
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg max-w-md w-full p-6 space-y-6 relative">
            <div class="flex justify-between items-center border-b border-zinc-900 pb-3">
                <span class="text-lg font-black uppercase tracking-wider">Acceso de Miembro</span>
                <button onclick="toggleUserModal()" class="text-zinc-400 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Correo Electrónico</label>
                    <input type="email" placeholder="atleta@vectra.test" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2.5 text-sm text-white focus:outline-none focus:border-white">
                </div>
                <div>
                    <label class="block text-xs font-mono text-zinc-400 uppercase mb-1">Contraseña</label>
                    <input type="password" placeholder="••••••••" class="w-full bg-zinc-900 border border-zinc-800 rounded p-2.5 text-sm text-white focus:outline-none focus:border-white">
                </div>
                <button onclick="alert('Sistema de autenticación conectado próximamente con Laravel Breeze/Sanctum.'); toggleUserModal();" class="w-full bg-white text-black font-bold py-3 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">
                    Iniciar Sesión
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL DE SOPORTE Y CONTACTO -->
    <div id="supportModal" class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 hidden flex items-center justify-center px-4">
        <div class="bg-zinc-950 border border-zinc-800 rounded-lg max-w-md w-full p-6 space-y-6 relative">
            <div class="flex justify-between items-center border-b border-zinc-900 pb-3">
                <span class="text-lg font-black uppercase tracking-wider">Soporte Técnico VECTRA</span>
                <button onclick="toggleSupportModal()" class="text-zinc-400 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div class="space-y-4 text-xs text-zinc-300">
                <p>¿Tienes dudas con el equipamiento o incidencias en el sistema de gestión? Nuestro equipo técnico atiende de lunes a viernes.</p>
                <div class="bg-zinc-900 p-3 rounded border border-zinc-800 space-y-1 font-mono">
                    <p class="text-white">Email: soporte@vectra-equipment.test</p>
                    <p class="text-white">Teléfono: +34 962 00 00 00</p>
                </div>
                <button onclick="toggleSupportModal(); alert('Mensaje simulado enviado correctamente al equipo de soporte de VECTRA.');" class="w-full bg-white text-black font-bold py-3 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">
                    Enviar Consulta Rápida
                </button>
            </div>
        </div>
    </div>

    <!-- CAJÓN LATERAL DEL CARRITO -->
    <div id="cartDrawer" class="fixed inset-y-0 right-0 bg-zinc-950 border-l border-zinc-800 z-50 w-full max-w-md transform translate-x-full transition-transform duration-300 ease-in-out p-8 flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center border-b border-zinc-900 pb-4 mb-6">
                <span class="text-xl font-black tracking-widest uppercase">Tu Bolsa (0)</span>
                <button onclick="toggleCartDrawer()" class="text-zinc-400 hover:text-white"><i data-lucide="x" class="w-6 h-6"></i></button>
            </div>
            <div class="text-center py-20 text-zinc-500 text-sm">
                Tu bolsa de compra está vacía actualmente.
            </div>
        </div>
        <div>
            <button onclick="alert('La pasarela de pago estará disponible en la versión final de VECTRA.');" class="w-full bg-white text-black font-bold py-3 text-xs uppercase tracking-widest hover:bg-zinc-200 transition-colors rounded">
                Proceder al Pago
            </button>
        </div>
    </div>

    <!-- SCRIPTS JS -->
    <script>
        lucide.createIcons();

        function toggleMenu() {
            const menu = document.getElementById('sideMenu');
            menu.classList.toggle('-translate-x-full');
        }

        function toggleSearchModal() {
            const modal = document.getElementById('searchModal');
            modal.classList.toggle('hidden');
        }

        function toggleUserModal() {
            const modal = document.getElementById('userModal');
            modal.classList.toggle('hidden');
        }

        function toggleSupportModal() {
            const modal = document.getElementById('supportModal');
            modal.classList.toggle('hidden');
        }

        function toggleCatalogModal() {
            const modal = document.getElementById('catalogModal');
            modal.classList.toggle('hidden');
        }

        function toggleNewsModal() {
            const modal = document.getElementById('newsModal');
            modal.classList.toggle('hidden');
        }

        function toggleCartDrawer() {
            const drawer = document.getElementById('cartDrawer');
            drawer.classList.toggle('translate-x-full');
        }

        // Cambio automático del carrusel cada 4 segundos
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        if (slides.length > 0) {
            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100', 'z-10');
                slides[currentSlide].classList.add('opacity-0', 'z-0');
                
                currentSlide = (currentSlide + 1) % slides.length;
                
                slides[currentSlide].classList.remove('opacity-0', 'z-0');
                slides[currentSlide].classList.add('opacity-100', 'z-10');
            }, 4000);
        }
    </script>
</body>
</html>
