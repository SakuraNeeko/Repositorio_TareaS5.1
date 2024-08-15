<?php
include '../config/db.php';
include '../models/Proveedor.php';

// Crear una instancia de la clase Proveedor
$proveedorModel = new Proveedor($pdo);

// Obtener la lista de proveedores
$proveedores = $proveedorModel->getAllProveedores();

// Obtener los cambios más recientes relacionados con proveedores
$sql_cambios = "SELECT * FROM cambios 
                WHERE tabla = 'proveedores' 
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
    <title>Lista de Proveedores</title>
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
            <h5 class="card-title">Lista de Proveedores</h5>
            <a href="proveedor_add.php" class="btn btn-primary mb-3">Añadir Proveedor</a>
            <a href="../index.php" class="btn btn-secondary mb-3">Volver</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($proveedor['proveedor_id']); ?></td>
                        <td><?php echo htmlspecialchars($proveedor['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($proveedor['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($proveedor['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($proveedor['email']); ?></td>
                        <td>
                            <a href="proveedor_edit.php?id=<?php echo htmlspecialchars($proveedor['proveedor_id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="../controllers/proveedor_delete.php?id=<?php echo htmlspecialchars($proveedor['proveedor_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este proveedor?');">Eliminar</a>
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
            <h5 class="card-title">Cambios Recientes en Proveedores</h5>
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
