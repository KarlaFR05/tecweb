<?php
namespace TECWEB\AppWeb\Update;

use TECWEB\AppWeb\DataBase;

class EditProduct extends DataBase {
    private $data;

    public function __construct($db, $user = 'root', $pass = 'Molly23') {
        $this->data = ['status' => 'error', 'message' => 'La consulta falló'];
        parent::__construct($db, $user, $pass);
    }

    public function update($jsonOBJ) {
        if (!isset($jsonOBJ->id)) {
            $this->data['message'] = 'ID no proporcionado';
            return;
        }

        $sql = "UPDATE productos SET 
                nombre='{$jsonOBJ->nombre}', 
                marca='{$jsonOBJ->marca}', 
                modelo='{$jsonOBJ->modelo}', 
                precio={$jsonOBJ->precio}, 
                detalles='{$jsonOBJ->detalles}', 
                unidades={$jsonOBJ->unidades}, 
                imagen='{$jsonOBJ->imagen}' 
                WHERE id={$jsonOBJ->id}";

        $this->conexion->set_charset("utf8");
        if ($this->conexion->query($sql)) {
            $this->data = ['status' => 'success', 'message' => 'Producto actualizado'];
        } else {
            $this->data['message'] = "ERROR: " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }

    public function getData() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}