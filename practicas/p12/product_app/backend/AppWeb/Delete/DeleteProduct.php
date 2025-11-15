<?php
namespace TECWEB\MYAPI\Delete;

use TECWEB\MYAPI\DataBase;

class DeleteProduct extends DataBase {
    private $data;

    public function __construct($db, $user = 'root', $pass = 'Molly23') {
        $this->data = ['status' => 'error', 'message' => 'La consulta falló'];
        parent::__construct($db, $user, $pass);
    }

    public function remove($id) {
        if (!isset($id)) {
            $this->data['message'] = 'ID no proporcionado';
            return;
        }

        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
        if ($this->conexion->query($sql)) {
            $this->data = ['status' => 'success', 'message' => 'Producto eliminado'];
        } else {
            $this->data['message'] = "ERROR: " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }

    public function getData() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}