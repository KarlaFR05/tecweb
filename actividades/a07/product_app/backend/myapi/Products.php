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

    public function getData() {
        return json_encode($this->response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}