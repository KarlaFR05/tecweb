<?php
namespace TECWEB\AppWeb\Read;

use TECWEB\AppWeb\DataBase;

class SearchProduct extends DataBase {
    private $data = [];

    public function __construct($db, $user = 'root', $pass = 'Molly23') {
        parent::__construct($db, $user, $pass);
    }

    public function search($search) {
        if (!isset($search)) {
            return;
        }

        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function getData() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}