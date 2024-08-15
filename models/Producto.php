<?php
class Producto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllProductos() {
        $stmt = $this->pdo->query("SELECT * FROM productos");
        return $stmt->fetchAll();
    }

    public function getProductoById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE producto_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createProducto($nombre, $descripcion, $precio, $stock) {
        $stmt = $this->pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio, $stock]);
    }

    public function updateProducto($id, $nombre, $descripcion, $precio, $stock) {
        $stmt = $this->pdo->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ? WHERE producto_id = ?");
        return $stmt->execute([$nombre, $descripcion, $precio, $stock, $id]);
    }

    public function deleteProducto($id) {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE producto_id = ?");
        return $stmt->execute([$id]);
    }
}
?>
