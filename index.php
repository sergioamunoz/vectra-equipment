<?php
    // 1. Aquí arriba creamos las variables (la "cocina" del servidor)
    $nombreMarca = "VECTRA Equipment";
    $precioProducto = 19.99;
    $usuario = "Sergio";
    $stock = 15;
    $enOferta = true;

    // Creamos un Array (una lista de productos)
    $productosVectra = [
        ["nombre" =>"Straps PRO vectra", "precio" => 19.90, "stock" => 10],
        ["nombre" =>"Rodilleras de Neopreno 5mm negras","precio" => 15.20, "stock" => 20],
        ["nombre" =>"Muñequeras de Rigidez Media negras","precio" => 9.90, "stock" => 15],
        ["nombre" =>"Cinturon de Halterofilia rojo","precio" => 59.90, "stock" => 17],
        ["nombre" =>"Coderas de fuerza","precio" => 12.00, "stock" => 18],
        ["nombre" =>"Pechera antirozaduras","precio" => 29.90, "stock" => 40],
        ["nombre" =>"Toalla de alta absorcion anti olores","precio" => 9.90, "stock" => 100]

    ];

    // Definimos la función. Se llama 'calcularValorAlmacen'
// Recibe dos datos (parámetros) entre paréntesis: el precio y el stock
function calcularValorAlmacen($precio, $stock) {
    // 1. Hace la operación matemática
    $resultado = $precio * $stock;
    
    // 2. Devuelve el resultado hacia afuera usando 'return'
    return $resultado;
}

function calcularValorTotalTienda($inventario) {
    // 1. Creamos una variable acumuladora que empieza en cero
    $totalGeneral = 0;
    
    // 2. Recorremos cada producto del array que le pasemos
    foreach ($inventario as $producto) {
        // 3. Calculamos el valor de este producto específico (precio * stock)
        $valorProducto = $producto['precio'] * $producto['stock'];
        
        // 4. Lo sumamos al acumulador total
        $totalGeneral = $totalGeneral + $valorProducto; // O también se puede escribir: $totalGeneral += $valorProducto;
    }
    
    // 5. Devolvemos el total ya sumado
    return $totalGeneral;
    
}
function contarProductosCaros($mayor20) {
    // 1. Creamos una variable acumuladora que empieza en cero
    $caros = 0;
    
    // 2. Recorremos cada producto del array que le pasemos
    foreach ($mayor20 as $producto) {
        // 3. Calculamos el valor de este producto específico (precio * stock)
        if ($producto['precio'] >20){
        $caros++;
        }
        // 4. Lo sumamos al acumulador total
         }
    
    // 5. Devolvemos el total ya sumado
    return $caros;
    
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Zona de Pruebas - VECTRA</title>
</head>
<body>

    <!-- 2. Aquí abajo (en el HTML) mostramos esas variables usando echo -->
    <h1>Bienvenido a la tienda: <?php echo $nombreMarca; ?></h1>
    
    <p>Hola <strong><?php echo $usuario; ?></strong>, bienvenido de nuevo.</p>
    
    <h2>Probando mi primer html y php</h2>
    <p>Estoy aprendiendo a estructurar páginas web paso a paso.</p>
    
    <p>El precio actual del producto es: <?php echo $precioProducto; ?> €</p>
    <p>Unidades disponibles en stock: <?php echo $stock; ?> unidades.</p>

    <?php if($enOferta): ?>
    <p style ="color: red; font-weight: bold";>¡Producto con 20% de descuento por tiempo limitado!</p>
    <?php else: ?>
    <p>Precio estandar</p>
    <?php endif; ?>

<h2>Catalogo de productos vectra</h2>
<ul>
    <?php foreach ($productosVectra as $producto): ?>
-         <li><?php echo $producto['nombre']; ?>
    <strong><?php echo $producto['precio']; ?> €</strong> (Stock: <?php echo $producto['stock']; ?>)</li>
    <?php endforeach; ?>
</ul>
<ul>
    <?php foreach ($productosVectra as $producto): ?>
        <li>
            <?php echo $producto['nombre']; ?> - 
            <strong><?php echo $producto['precio']; ?> €</strong> 
            (Stock: <?php echo $producto['stock']; ?>) — 
            
            <!-- AQUÍ USAMOS NUESTRA FUNCIÓN -->
            <em>Valor en almacén: <?php echo calcularValorAlmacen($producto['precio'], $producto['stock']); ?> €</em>
        </li>
    <?php endforeach; ?>
</ul>
<p><strong>Valor total del inventario en la tienda: </strong> 
    <?php echo calcularValorTotalTienda($productosVectra); ?> €
</p>
<p><strong>Productos caros en la tienda: </strong> 
    <?php echo contarProductosCaros($productosVectra); ?> 
</p>
    <br>
    <button>Guardar y probar</button>
</body>
</html>