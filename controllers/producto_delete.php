<?php
include '../config/db.php';
include '../models/Producto.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    if (empty($id)) {
        die("ID del producto no proporcionado.");
    }

    $producto = new Producto($pdo);

    if ($producto->deleteProducto($id)) {
        header("Location: ../views/producto_index.php");
        exit();
    } else {
        die("Error al eliminar el producto.");
    }
} else {
    die("Método de solicitud no permitido.");
}
