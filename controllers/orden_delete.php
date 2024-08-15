<?php
include '../config/db.php';
include '../models/OrdenCompra.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Crear instancia de OrdenCompra
    $ordenCompra = new OrdenCompra($pdo);

    // Eliminar la orden de compra utilizando el método definido en OrdenCompra
    if ($ordenCompra->deleteOrdenCompra($id)) {
        header("Location: ../views/orden_index.php");
    } else {
        echo "Error al eliminar la orden de compra.";
    }
}
?>
