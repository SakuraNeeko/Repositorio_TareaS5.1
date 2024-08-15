<?php
include '../config/db.php';
include '../models/Producto.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock)) {
        die("Todos los campos son obligatorios.");
    }

    $producto = new Producto($pdo);

    if ($producto->createProducto($nombre, $descripcion, $precio, $stock)) {
        header("Location: ../views/producto_index.php");
        exit();
    } else {
        die("Error al agregar el producto.");
    }
} else {
    die("Método de solicitud no permitido.");
}
