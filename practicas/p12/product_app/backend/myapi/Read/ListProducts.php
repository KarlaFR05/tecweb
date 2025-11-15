<?php
namespace TECWEB\MYAPI\Read;

use TECWEB\MYAPI\DataBase;

class ListProducts extends DataBase {
    private $data = [];

    public function __construct($db, $user = 'root', $pass = 'Molly23') {
        parent::__construct($db, $user, $pass);
    }

    public function getAll() {
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
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