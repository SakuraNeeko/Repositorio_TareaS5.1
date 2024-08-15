<?php
class Proveedor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllProveedores() {
        $stmt = $this->pdo->query("SELECT * FROM proveedores");
        return $stmt->fetchAll();
    }

    public function getProveedorById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM proveedores WHERE proveedor_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createProveedor($nombre, $direccion, $telefono, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO proveedores (nombre, direccion, telefono, email) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $direccion, $telefono, $email]);
    }

    public function updateProveedor($id, $nombre, $direccion, $telefono, $email) {
        // Obtener los valores actuales del proveedor
        $stmt = $this->pdo->prepare("SELECT * FROM proveedores WHERE proveedor_id = ?");
        $stmt->execute([$id]);
        $proveedor = $stmt->fetch();

        $cambios = [];

        // Comparar y registrar cambios
        if ($nombre !== $proveedor['nombre']) {
            $cambios[] = [
                'campo' => 'nombre',
                'valor_anterior' => $proveedor['nombre'],
                'valor_nuevo' => $nombre
            ];
        }
        if ($direccion !== $proveedor['direccion']) {
            $cambios[] = [
                'campo' => 'direccion',
                'valor_anterior' => $proveedor['direccion'],
                'valor_nuevo' => $direccion
            ];
        }
        if ($telefono !== $proveedor['telefono']) {
            $cambios[] = [
                'campo' => 'telefono',
                'valor_anterior' => $proveedor['telefono'],
                'valor_nuevo' => $telefono
            ];
        }
        if ($email !== $proveedor['email']) {
            $cambios[] = [
                'campo' => 'email',
                'valor_anterior' => $proveedor['email'],
                'valor_nuevo' => $email
            ];
        }

        // Actualizar proveedor
        $stmt = $this->pdo->prepare("UPDATE proveedores SET nombre = ?, direccion = ?, telefono = ?, email = ? WHERE proveedor_id = ?");
        $stmt->execute([$nombre, $direccion, $telefono, $email, $id]);

        // Registrar cambios
        foreach ($cambios as $cambio) {
            $stmt_cambio = $this->pdo->prepare("INSERT INTO cambios (fecha, tabla, campo, valor_anterior, valor_nuevo, registro_id) VALUES (NOW(), 'proveedores', ?, ?, ?, ?)");
            $stmt_cambio->execute([$cambio['campo'], $cambio['valor_anterior'], $cambio['valor_nuevo'], $id]);
        }

        return $stmt->rowCount() > 0;
    }

    public function deleteProveedor($id) {
        $stmt = $this->pdo->prepare("DELETE FROM proveedores WHERE proveedor_id = ?");
        return $stmt->execute([$id]);
    }
}
?>
