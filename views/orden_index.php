<?php
include '../config/db.php';
include '../models/OrdenCompra.php';

// Crear una instancia de la clase OrdenCompra
$ordenCompraModel = new OrdenCompra($pdo);

// Obtener la lista de órdenes de compra
$ordenes = $ordenCompraModel->getAllOrdenesCompra();

// Obtener los cambios más recientes relacionados con órdenes de compra
$sql_cambios = "SELECT * FROM cambios 
                WHERE tabla = 'ordenes_compra' 
                ORDER BY fecha DESC 
                LIMIT 10";
$stmt_cambios = $pdo->query($sql_cambios);
$cambios = $stmt_cambios->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Órdenes de Compra</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            background-color: #fff0f5;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #ff9999;
            border-color: #ff9999;
        }
        .btn-primary:hover {
            background-color: #ff8080;
            border-color: #ff8080;
        }
        .status-pending {
            background-color: #fff5e6; /* Amarillo pastel */
            color: #ffcc00;
            border-radius: 5px;
            padding: 5px;
        }
        .status-complete {
            background-color: #e6ffe6; /* Verde pastel */
            color: #66ff66;
            border-radius: 5px;
            padding: 5px;
        }
        .status-cancelled {
            background-color: #ffe6e6; /* Rojo pastel */
            color: #ff6666;
            border-radius: 5px;
            padding: 5px;
        }
        .table-container {
            margin-top: 30px;
        }
        .table-wrapper {
            max-height: 400px;
            overflow-y: auto;
        }
        .table thead th {
            background-color: #ff9999;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Listado de Órdenes de Compra</h5>
            <a href="orden_add.php" class="btn btn-primary mb-3">Agregar Nueva Orden</a>
            <a href="../index.php" class="btn btn-secondary mb-3">Volver</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordenes as $orden): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($orden['id']); ?></td>
                            <td><?php echo htmlspecialchars($orden['proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($orden['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($orden['total']); ?></td>
                            <td>
                                <?php 
                                    $estado = htmlspecialchars($orden['estado']);
                                    if ($estado == 'Pendiente') {
                                        echo "<span class='status-pending'>$estado</span>";
                                    } elseif ($estado == 'Completa') {
                                        echo "<span class='status-complete'>$estado</span>";
                                    } elseif ($estado == 'Cancelada') {
                                        echo "<span class='status-cancelled'>$estado</span>";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="orden_edit.php?id=<?php echo htmlspecialchars($orden['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="../controllers/orden_delete.php?id=<?php echo htmlspecialchars($orden['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta orden?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabla de Cambios Recientes -->
    <div class="card table-container">
        <div class="card-body">
            <h5 class="card-title">Cambios Recientes en Órdenes de Compra</h5>
            <div class="table-wrapper">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Campo</th>
                            <th>Valor Anterior</th>
                            <th>Valor Nuevo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cambios as $cambio): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cambio['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($cambio['campo']); ?></td>
                            <td><?php echo htmlspecialchars($cambio['valor_anterior']); ?></td>
                            <td><?php echo htmlspecialchars($cambio['valor_nuevo']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>