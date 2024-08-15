<?php
class OrdenCompra {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllOrdenesCompra() {
        $stmt = $this->pdo->query("SELECT o.id, o.fecha, o.total, o.estado, p.nombre AS proveedor 
                                   FROM ordenes_compra o
                                   JOIN proveedores p ON o.proveedor_id = p.proveedor_id");
        return $stmt->fetchAll();
    }

    public function getOrdenCompraById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM ordenes_compra WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function createOrdenCompra($proveedor_id, $fecha, $total, $estado) {
        $stmt = $this->pdo->prepare("INSERT INTO ordenes_compra (proveedor_id, fecha, total, estado) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$proveedor_id, $fecha, $total, $estado]);
    }

    public function updateOrdenCompra($id, $proveedor_id, $fecha, $total, $estado) {
        $stmt = $this->pdo->prepare("UPDATE ordenes_compra SET proveedor_id = ?, fecha = ?, total = ?, estado = ? WHERE id = ?");
        return $stmt->execute([$proveedor_id, $fecha, $total, $estado, $id]);
    }

    public function deleteOrdenCompra($id) {
        $stmt = $this->pdo->prepare("DELETE FROM ordenes_compra WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

