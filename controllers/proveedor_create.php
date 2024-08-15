<?php
include '../config/db.php';
include '../models/Proveedor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    if (empty($nombre) || empty($direccion) || empty($telefono) || empty($email)) {
        die("Todos los campos son obligatorios.");
    }

    $proveedor = new Proveedor($pdo);

    if ($proveedor->createProveedor($nombre, $direccion, $telefono, $email)) {
        header("Location: ../views/proveedor_index.php");
        exit();
    } else {
        die("Error al agregar el proveedor.");
    }
} else {
    die("Método de solicitud no permitido.");
}
