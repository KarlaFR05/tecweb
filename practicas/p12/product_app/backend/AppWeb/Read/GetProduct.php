<?php
namespace TECWEB\AppWeb\Read;

use TECWEB\AppWeb\DataBase;

class GetProduct extends DataBase {
    private $data = [];

    public function __construct($db, $user = 'root', $pass = 'Molly23') {
        parent::__construct($db, $user, $pass);
    }

    public function single($id) {
        if (!isset($id)) {
            return;
        }

        if ($result = $this->conexion->query("SELECT * FROM productos WHERE id = {$id}")) {
            $row = $result->fetch_assoc();
            if (!is_null($row)) {
                foreach ($row as $key => $value) {
                    $this->data[$key] = $value;
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