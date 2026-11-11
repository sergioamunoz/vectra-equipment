<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        // 1. Anuncios dinámicos para la barra superior
        $anuncios = [
            "ENVÍO GRATIS EN PEDIDOS SUPERIORES A 60€",
            "10% DE DESCUENTO PARA ESTUDIANTES CON VERIFICACIÓN",
            "NUEVAS RODILLERAS SCR 7MM YA DISPONIBLES"
        ];

        // 2. Las 5 imágenes del Carrusel Principal (Hero Slider)
        $carruselHero = [
            [
                'titulo' => 'PACKS DE RENDIMIENTO',
                'subtitulo' => 'Equipamiento completo para tus entrenamientos más exigentes',
                'imagen' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1600'
            ],
            [
                'titulo' => 'STRAPS DE AGARRE EXTRA REFORZADOS',
                'subtitulo' => 'Soporte total en peso muerto pesado',
                'imagen' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1600'
            ],
            [
                'titulo' => 'CINTURÓN DE LUMBARIA Y FUERZA',
                'subtitulo' => 'Estabilidad intraabdominal máxima',
                'imagen' => 'https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?q=80&w=1600'
            ],
            [
                'titulo' => 'RODILLERAS NEOPRENO SCR 7MM',
                'subtitulo' => 'Compresión biomecánica para sentadilla',
                'imagen' => 'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?q=80&w=1600'
            ],
            [
                'titulo' => 'MUÑEQUERAS DE SOPORTE RÍGIDO',
                'subtitulo' => 'Protección articular en press de banca',
                'imagen' => 'https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=1600'
            ]
        ];

        // 3. Opciones principales del menú desplegable
        $menuOpciones = ['COLABORACIONES', 'MUJERES', 'HOMBRE', 'EQUIPAMIENTO'];

        // 4. Datos legales corporativos para el Footer
        $datosEmpresa = [
            'nombre' => 'VECTRA STRENGTH S.L.',
            'cif' => 'B-12345678',
            'direccion' => 'Gandia, Valencia, España',
            'email' => 'soporte@vectra.test'
        ];

        // Enviamos todo empaquetado a la vista welcome
        return view('welcome', compact('anuncios', 'carruselHero', 'menuOpciones', 'datosEmpresa'));
    }
}