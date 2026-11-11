<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 1. PORTADA PRINCIPAL (Variables para la vista welcome)
Route::get('/', function () {
    $anuncios = [
        "🔥 ENVÍOS GRATIS EN PEDIDOS SUPERIORES A 50€",
        "⚡ NUEVA COLECCIÓN DE EQUIPAMIENTO VECTRA DISPONIBLE",
        "💪 DISEÑADO PARA ALTO RENDIMIENTO Y FITNESS"
    ];

    $carruselHero = [
        [
            'imagen' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1600&auto=format&fit=crop',
            'titulo' => 'Rendimiento Extremo',
            'subtitulo' => 'Diseñado para atletas que exigen la máxima resistencia en cada entrenamiento.'
        ],
        [
            'imagen' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1600&auto=format&fit=crop',
            'titulo' => 'Tecnología VECTRA',
            'subtitulo' => 'Equipamiento de alta gama para centros de alto rendimiento y gimnasios.'
        ]
    ];

    $datosEmpresa = [
        'nombre' => 'VECTRA Equipment S.L.',
        'cif' => 'B-12345678',
        'direccion' => 'Calle Mayor 45, Gandia (Valencia)',
        'email' => 'soporte@vectra-equipment.test'
    ];

    return view('welcome', compact('anuncios', 'carruselHero', 'datosEmpresa'));
});

// 2. READ: Listar productos en el panel de inventario
Route::get('/inventario', [ProductController::class, 'inventario']);

// 3. CREATE: Recibir el formulario y guardar el nuevo producto
Route::post('/inventario/guardar', [ProductController::class, 'store']);

// 4. UPDATE (Vista): Mostrar formulario de edición cargando el ID del producto
Route::get('/inventario/editar/{id}', [ProductController::class, 'edit']);

// 5. UPDATE (Acción): Guardar las modificaciones en la base de datos
Route::put('/inventario/actualizar/{id}', [ProductController::class, 'update']);

// 6. DELETE: Borrar el producto de la base de datos
Route::delete('/inventario/eliminar/{id}', [ProductController::class, 'destroy']);