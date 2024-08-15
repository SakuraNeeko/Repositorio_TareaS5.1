<?php
include '../config/db.php';
include '../models/OrdenCompra.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $proveedor_id = $_POST['proveedor_id'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];

    // Crear instancia de OrdenCompra
    $ordenCompra = new OrdenCompra($pdo);

    // Obtener los valores actuales antes de la actualización
    $orden = $ordenCompra->getOrdenCompraById($id);

    if ($orden) {
        $valores_antiguos = [
            'proveedor_id' => $orden['proveedor_id'],
            'fecha' => $orden['fecha'],
            'total' => $orden['total'],
            'estado' => $orden['estado']
        ];

        // Actualizar la orden de compra utilizando el método definido en OrdenCompra
        if ($ordenCompra->updateOrdenCompra($id, $proveedor_id, $fecha, $total, $estado)) {
            // Registrar los cambios en la tabla de cambios
            $campos = ['proveedor_id', 'fecha', 'total', 'estado'];
            foreach ($campos as $campo) {
                if ($valores_antiguos[$campo] != $$campo) {
                    $stmt_cambio = $pdo->prepare("INSERT INTO cambios (tabla, id_registro, campo, valor_anterior, valor_nuevo, fecha) VALUES (?, ?, ?, ?, ?, NOW())");
                    $stmt_cambio->execute(['ordenes_compra', $id, $campo, $valores_antiguos[$campo], $$campo]);
                }
            }
            header("Location: ../views/orden_index.php");
        } else {
            echo "Error al actualizar la orden de compra.";
        }
    } else {
        echo "Orden de compra no encontrada.";
    }
}
