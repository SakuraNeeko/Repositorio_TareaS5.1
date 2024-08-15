<?php
include '../config/db.php';
include '../models/Producto.php';

// Crear una instancia de la clase Producto
$productoModel = new Producto($pdo);

// Obtener la lista de productos
$productos = $productoModel->getAllProductos();

$cambios = [];

// Obtener los cambios más recientes relacionados con productos
try {
    $sql_cambios = "SELECT c.fecha, c.registro_id AS producto_id, c.campo, c.valor_anterior, c.valor_nuevo
                    FROM cambios c
                    WHERE c.tabla = 'productos'
                    ORDER BY c.fecha DESC 
                    LIMIT 10";
    $stmt_cambios = $pdo->query($sql_cambios);
    $cambios = $stmt_cambios->fetchAll();
} catch (PDOException $e) {
    // Manejar error en la consulta
    echo "Error al obtener cambios: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
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
            <h5 class="card-title">Lista de Productos</h5>
            <a href="producto_add.php" class="btn btn-primary mb-3">Añadir Producto</a>
            <a href="../index.php" class="btn btn-secondary mb-3">Volver</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['producto_id']); ?></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                        <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                        <td>
                            <a href="producto_edit.php?id=<?php echo htmlspecialchars($producto['producto_id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="../controllers/producto_delete.php?id=<?php echo htmlspecialchars($producto['producto_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
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
            <h5 class="card-title">Cambios Recientes en Productos</h5>
            <div class="table-wrapper">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>ID Producto</th>
                            <th>Campo</th>
                            <th>Valor Anterior</th>
                            <th>Valor Nuevo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cambios as $cambio): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cambio['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($cambio['producto_id']); ?></td>
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