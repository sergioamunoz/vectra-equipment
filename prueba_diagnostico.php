<?php

// 1. Nuestro array original con todos los productos de VECTRA
$productosVectra = [
    ["nombre" => "strapsVectra", "precio" => 12.00, "stock" => 10],
    ["nombre" => "RodillerasVectra", "precio" => 15.00, "stock" => 13],
    ["nombre" => "MuñequerasVectra", "precio" => 17.00, "stock" => 17] // Este tiene más de 15, no debe salir
];

function calcularValorTotal($ListadoProductos) {
    // 1. Creamos una variable acumuladora que empieza en cero
    $totalGeneral = 0;
    
    // 2. Recorremos cada producto del array que le pasemos
    foreach ($ListadoProductos as $producto) {
        // 3. Calculamos el valor de este producto específico (precio * stock)
        $valorProducto = $producto['precio'] * $producto['stock'];
        
        // 4. Lo sumamos al acumulador total
        $totalGeneral = $totalGeneral + $valorProducto; // O también se puede escribir: $totalGeneral += $valorProducto;
    }
    
    // 5. Devolvemos el total ya sumado
    return $totalGeneral;
    
}
$valorTotal = calcularValorTotal($productosVectra);

// 2. La función que filtra y devuelve la "caja" con los productos críticos
function obtenerProductosCriticos($listadoProductos)
{
    $alertaReposicion = []; // 📦 Caja vacía al inicio

    foreach ($listadoProductos as $producto) {
        // Si el stock es menor a 15...
        if ($producto['stock'] < 15) {
            // ¡Lo metemos dentro de nuestra caja!
        $alertaReposicion[] = $producto;
        }
    }

    // Devolvemos la caja llena con los productos filtrados
    return $alertaReposicion;
}

// 3. Ejecutamos la función y guardamos el resultado en una variable
$productosAReponer = obtenerProductosCriticos($productosVectra);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Prueba de Filtrado - VECTRA</title>
</head>

<body>

    <h2>Listado de Reposición Urgente</h2>

    <ul>
        <?php foreach ($productosAReponer as $item): ?>
            <li>
                El producto <strong><?php echo $item['nombre']; ?></strong>
                tiene un stock crítico de <strong><?php echo $item['stock']; ?></strong> unidades.
            </li>
        <?php endforeach; ?>

    </ul>
    <p><strong>Valor total del inventario en la tienda: </strong> 
    <?php echo $valorTotal; ?> €
</p>

</body>

</html>