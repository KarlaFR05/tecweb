<?php
namespace TECWEB\MYAPI;

require_once __DIR__ . '/DataBase.php';

class Products extends DataBase {
    private $response = [];

    public function __construct($dbName, $dbHost = 'localhost', $dbUser = 'root', $dbPass = 'Molly23') {
        parent::__construct($dbHost, $dbUser, $dbPass, $dbName);
    }

    public function list() {
        $sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado 
                FROM productos WHERE eliminado = 0";
        $result = $this->conexion->query($sql);
        $this->response = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function singleByName($nombre) {
        $nombre = $this->conexion->real_escape_string($nombre);
        $sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado 
                FROM productos WHERE nombre = '$nombre' AND eliminado = 0 LIMIT 1";
        $result = $this->conexion->query($sql);
        $this->response = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function search($term) {
        $term = $this->conexion->real_escape_string($term);
        $sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado 
                FROM productos 
                WHERE (id = '$term' OR nombre LIKE '%$term%' OR marca LIKE '%$term%' OR detalles LIKE '%$term%') 
                AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $this->response = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function singleById($id) {
        $id = (int)$id;
        $sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado 
                FROM productos WHERE id = $id AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $this->response = $result ? $result->fetch_assoc() : [];
    }
  
    public function checkName($nombre) {
        $nombre = $this->conexion->real_escape_string($nombre);
        $sql = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $exists = $result && $result->num_rows > 0;
        $this->response = [
            'exists' => $exists,
            'message' => $exists ? 'El nombre del producto ya existe.' : ''
        ];
    }

    public function add($data) {
        $nombre = $this->conexion->real_escape_string($data['nombre']);
        $marca = $this->conexion->real_escape_string($data['marca']);
        $modelo = $this->conexion->real_escape_string($data['modelo']);
        $precio = (float)($data['precio'] ?? 0);
        $detalles = $this->conexion->real_escape_string($data['detalles'] ?? 'NA');
        $unidades = (int)($data['unidades'] ?? 0);
        $imagen = $this->conexion->real_escape_string($data['imagen'] ?? 'img/default.png');

        // Verificar si ya existe
        $sql = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        if ($result && $result->num_rows > 0) {
            $this->response = ['status' => 'error', 'message' => 'Ya existe un producto con ese nombre'];
            return;
        }

        $sql = "INSERT INTO productos VALUES (null, '$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";
        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto agregado'];
        } else {
            $this->response = ['status' => 'error', 'message' => 'ERROR: ' . $this->conexion->error];
        }
    }

    public function edit($data) {
        $id = (int)($data['id'] ?? 0);
        if ($id <= 0) {
            $this->response = ['status' => 'error', 'message' => 'ID inválido'];
            return;
        }

        $nombre = $this->conexion->real_escape_string($data['nombre']);
        $marca = $this->conexion->real_escape_string($data['marca']);
        $modelo = $this->conexion->real_escape_string($data['modelo']);
        $precio = (float)($data['precio'] ?? 0);
        $detalles = $this->conexion->real_escape_string($data['detalles'] ?? 'NA');
        $unidades = (int)($data['unidades'] ?? 0);
        $imagen = $this->conexion->real_escape_string($data['imagen'] ?? 'img/default.png');

        $sql = "UPDATE productos SET 
                nombre='$nombre', marca='$marca', modelo='$modelo', 
                precio=$precio, detalles='$detalles', unidades=$unidades, imagen='$imagen' 
                WHERE id=$id";
        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto actualizado'];
        } else {
            $this->response = ['status' => 'error', 'message' => 'ERROR: ' . $this->conexion->error];
        }
    }

    public function delete($id) {
        $id = (int)$id;
        if ($id <= 0) {
            $this->response = [
                'status' => 'error',
                'message' => 'ID inválido'
            ];
            return;
        }

        $sql = "UPDATE productos SET eliminado = 0 WHERE id = $id";
        if ($this->conexion->query($sql)) {
            if ($this->conexion->affected_rows > 0) {
                $this->response = [
                    'status' => 'success',
                    'message' => 'Producto eliminado correctamente'
                ];
            } else {
                $this->response = [
                    'status' => 'error',
                    'message' => 'No se encontró el producto con ese ID'
                ];
            }
        } else {
            $this->response = [
                'status' => 'error',
                'message' => 'ERROR SQL: ' . $this->conexion->error
            ];
        }
    }

    public function getData() {
        return json_encode($this->response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}