<?php
include '../config/db.php';
include '../models/Producto.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    if (empty($id) || empty($nombre) || empty($descripcion) || empty($precio) || empty($stock)) {
        die("Todos los campos son obligatorios.");
    }

    $producto = new Producto($pdo);

    $producto_actual = $producto->getProductoById($id);

    if (!$producto_actual) {
        die("Producto no encontrado.");
    }

    if ($producto->updateProducto($id, $nombre, $descripcion, $precio, $stock)) {
        // Registrar cambios en la tabla de cambios
        $campos = ['nombre', 'descripcion', 'precio', 'stock'];
        foreach ($campos as $campo) {
            if ($producto_actual[$campo] != $$campo) {
                $stmt_cambio = $pdo->prepare("INSERT INTO cambios (tabla, campo, valor_anterior, valor_nuevo, registro_id) VALUES ('productos', ?, ?, ?, ?)");
                $stmt_cambio->execute([$campo, $producto_actual[$campo], $$campo, $id]);
            }
        }

        header("Location: ../views/producto_index.php");
        exit();
    } else {
        die("Error al actualizar el producto.");
    }
} else {
    die("Método de solicitud no permitido.");
}

