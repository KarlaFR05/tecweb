<?php
namespace TECWEB\MYAPI;

abstract class DataBase {
    protected $conexion;

    public function __construct($dbHost = 'localhost', $dbUser = 'root', $dbPass = 'Molly23', $dbName = 'marketzone') {
        $this->conexion = new \mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
        $this->conexion->set_charset("utf8");
    }
}