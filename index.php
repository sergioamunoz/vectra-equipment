<?php

// 1. Reutilizamos la conexión externa de forma limpia
require_once 'conexion.php';

// 2. Procesamos GUARDAR un producto nuevo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_producto'])) {
    $nuevoNombre = $_POST['nombre'] ?? '';
    $nuevoPrecio = $_POST['precio'] ?? 0;
    $nuevoStock  = $_POST['stock'] ?? 0;

    if (!empty($nuevoNombre) && $nuevoPrecio > 0 && $nuevoStock >= 0) {
        $sqlInsert = "INSERT INTO productos (nombre, precio, stock) VALUES (:nombre, :precio, :stock)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([
            ':nombre' => $nuevoNombre,
            ':precio' => $nuevoPrecio,
            ':stock'  => $nuevoStock
        ]);

        header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
        exit();
    }
}

// 3. Procesamos ACTUALIZAR un producto existente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_producto'])) {
    $idModificar = (int)($_POST['id_producto'] ?? 0);
    $nombreMod   = $_POST['nombre'] ?? '';
    $precioMod   = $_POST['precio'] ?? 0;
    $stockMod    = $_POST['stock'] ?? 0;

    if ($idModificar > 0 && !empty($nombreMod) && $precioMod > 0 && $stockMod >= 0) {
        $sqlUpdate = "UPDATE productos SET nombre = :nombre, precio = :precio, stock = :stock WHERE id = :id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([
            ':nombre' => $nombreMod,
            ':precio' => $precioMod,
            ':stock'  => $stockMod,
            ':id'     => $idModificar
        ]);

        header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
        exit();
    }
}

// 4. Procesamos ELIMINAR un producto
if (isset($_GET['eliminar'])) {
    $idAEliminar = (int)$_GET['eliminar'];

    if ($idAEliminar > 0) {
        $sqlDelete = "DELETE FROM productos WHERE id = :id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->execute([':id' => $idAEliminar]);

        header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
        exit();
    }
}

// 5. Verificamos si estamos editando para cargar los datos en el formulario
$productoAEditar = null;
if (isset($_GET['editar'])) {
    $idEditar = (int)$_GET['editar'];
    if ($idEditar > 0) {
        $stmtEdit = $pdo->prepare("SELECT id, nombre, precio, stock FROM productos WHERE id = :id");
        $stmtEdit->execute([':id' => $idEditar]);
        $productoAEditar = $stmtEdit->fetch(PDO::FETCH_ASSOC);
    }
}

// 6. Consultas y funciones de negocio
$stmt = $pdo->query("SELECT id, nombre, precio, stock FROM productos");
$productosVectra = $stmt->fetchAll(PDO::FETCH_ASSOC);

function calcularValorTotal(array $listadoProductos): float {
    $totalGeneral = 0.0;
    foreach ($listadoProductos as $producto) {
        $totalGeneral += (float)$producto['precio'] * (int)$producto['stock'];
    }
    return $totalGeneral;
}

function obtenerProductosCriticos(array $listadoProductos): array {
    $alertaReposicion = [];
    foreach ($listadoProductos as $producto) {
        if ($producto['stock'] < 15) {
            $alertaReposicion[] = $producto;
        }
    }
    return $alertaReposicion;
}

$valorTotal = calcularValorTotal($productosVectra);
$productosAReponer = obtenerProductosCriticos($productosVectra);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VECTRA - Panel CRUD Completo</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        form { background: #f4f4f4; padding: 20px; width: 300px; border-radius: 8px; margin-bottom: 20px; }
        input { display: block; width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button { background: #000; color: #fff; border: none; padding: 10px; width: 100%; cursor: pointer; }
        button:hover { background: #333; }
        .btn-editar { color: #007bff; text-decoration: none; font-weight: bold; font-size: 14px; margin-left: 10px; }
        .btn-eliminar { color: #d9534f; text-decoration: none; font-weight: bold; font-size: 14px; margin-left: 10px; }
        .btn-editar:hover, .btn-eliminar:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <!-- Formulario dinámico: cambia entre Guardar o Actualizar -->
    <h2><?php echo $productoAEditar ? 'Editar Producto' : 'Añadir Nuevo Producto a VECTRA'; ?></h2>
    
    <form action="" method="POST">
        <?php if ($productoAEditar): ?>
            <!-- Campo oculto para llevar el ID cuando actualizamos -->
            <input type="hidden" name="id_producto" value="<?php echo $productoAEditar['id']; ?>">
        <?php endif; ?>

        <label>Nombre del producto:</label>
        <input type="text" name="nombre" required value="<?php echo $productoAEditar ? htmlspecialchars($productoAEditar['nombre']) : ''; ?>" placeholder="Ej: MagnesioVectra">

        <label>Precio (€):</label>
        <input type="number" step="0.01" name="precio" required value="<?php echo $productoAEditar ? $productoAEditar['precio'] : ''; ?>" placeholder="19.99">

        <label>Stock inicial:</label>
        <input type="number" name="stock" required value="<?php echo $productoAEditar ? $productoAEditar['stock'] : ''; ?>" placeholder="20">

        <button type="submit" name="<?php echo $productoAEditar ? 'actualizar_producto' : 'guardar_producto'; ?>">
            <?php echo $productoAEditar ? 'Actualizar Producto' : 'Guardar en Base de Datos'; ?>
        </button>

        <?php if ($productoAEditar): ?>
            <a href="index.php" style="display: block; text-align: center; margin-top: 10px; color: #666; text-decoration: none; font-size: 13px;">Cancelar edición</a>
        <?php endif; ?>
    </form>

    <hr>

    <h2>Inventario General</h2>
    <ul>
        <?php foreach ($productosVectra as $item): ?>
            <li>
                <strong><?php echo htmlspecialchars($item['nombre']); ?></strong> — 
                Precio: <?php echo number_format((float)$item['precio'], 2); ?> € — 
                Stock: (<?php echo (int)$item['stock']; ?> unidades)
                
                <!-- Botones de Editar y Eliminar -->
                <a href="?editar=<?php echo $item['id']; ?>" class="btn-editar">[Editar]</a>
                <a href="?eliminar=<?php echo $item['id']; ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">[Eliminar]</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>

    <h2>Listado de Reposición Urgente (Stock &lt; 15)</h2>
    <ul>
        <?php foreach ($productosAReponer as $item): ?>
            <li>
                El producto <strong><?php echo htmlspecialchars($item['nombre']); ?></strong> 
                tiene un stock crítico de <strong><?php echo (int)$item['stock']; ?></strong> unidades.
            </li>
        <?php endforeach; ?>
    </ul>

    <p><strong>Valor total del inventario:</strong> <?php echo number_format($valorTotal, 2); ?> €</p>

</body>
</html>