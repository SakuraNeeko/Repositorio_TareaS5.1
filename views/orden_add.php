<?php
include '../config/db.php';

// Obtener proveedores para el desplegable
$stmt = $pdo->query("SELECT proveedor_id, nombre FROM proveedores");
$proveedores = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Orden de Compra</title>
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
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Agregar Orden de Compra</h5>
            <form action="../controllers/orden_create.php" method="POST">
                <div class="form-group">
                    <label for="proveedor_id">Proveedor</label>
                    <select class="form-control" id="proveedor_id" name="proveedor_id" required>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?php echo htmlspecialchars($proveedor['proveedor_id']); ?>">
                                <?php echo htmlspecialchars($proveedor['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" class="form-control" id="total" name="total" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Completa">Completa</option>
                        <option value="Cancelada">Cancelada</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Orden</button>
                <a href="orden_index.php" class="btn btn-secondary mb-3">Volver</a>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
