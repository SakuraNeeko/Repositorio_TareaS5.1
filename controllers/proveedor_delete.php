<?php
include '../config/db.php';
include '../models/Proveedor.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    if (empty($id)) {
        die("ID del proveedor no proporcionado.");
    }

    $proveedor = new Proveedor($pdo);

    if ($proveedor->deleteProveedor($id)) {
        header("Location: ../views/proveedor_index.php");
        exit();
    } else {
        die("Error al eliminar el proveedor.");
    }
} else {
    die("Método de solicitud no permitido.");
}
