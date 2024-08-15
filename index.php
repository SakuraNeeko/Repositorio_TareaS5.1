<?php
include 'config/db.php';

// Obtener los cambios más recientes (por ejemplo, los últimos 10 cambios en productos y proveedores)
$sql = "SELECT * FROM cambios 
        WHERE tabla IN ('productos', 'proveedores') 
        ORDER BY fecha DESC 
        LIMIT 10";
$stmt = $pdo->query($sql);
$cambios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://wallpapers-clan.com/wp-content/uploads/2024/03/anime-girl-beautiful-landscape-desktop-wallpaper-preview.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: #333;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
        }
        .jumbotron {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con opacidad para mejorar la legibilidad */
            border-radius: 15px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            display: inline-block;
        }
        .btn-primary {
            background-color: #ff9999;
            border-color: #ff9999;
            border-radius: 50px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #ff8080;
            border-color: #ff8080;
            box-shadow: 0px 5px 10px rgba(255, 128, 128, 0.5);
        }
        .btn-secondary {
            border-radius: 50px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            box-shadow: 0px 5px 10px rgba(128, 128, 128, 0.5);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="jumbotron text-center">
        <h1 class="display-4">Bienvenido - Sistema de Gestión de Inventarios</h1>
        <p class="lead">Administrador de productos, proveedores y órdenes de compra.</p>
        <hr class="my-4">
        <p>Navegar</p>
        <a class="btn btn-primary btn-lg" href="views/producto_index.php" role="button">Ver Productos</a>
        <a class="btn btn-secondary btn-lg" href="views/proveedor_index.php" role="button">Ver Proveedores</a>
        <a class="btn btn-primary btn-lg" href="views/orden_index.php" role="button">Ver Órdenes de Compra</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
