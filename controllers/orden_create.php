<?php
include '../config/db.php';
include '../models/OrdenCompra.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proveedor_id = $_POST['proveedor_id'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];

    $ordenCompra = new OrdenCompra($pdo);
    
    if ($ordenCompra->createOrdenCompra($proveedor_id, $fecha, $total, $estado)) {
        header("Location: ../views/orden_index.php");
    } else {
        echo "Error al crear la orden de compra.";
    }
}
