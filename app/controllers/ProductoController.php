<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 17/05/2021
 * Time: 22:11
 */
require 'app/models/Producto.php';
class ProductoController
{
    private $log;
    private $producto;

    public function __construct()
    {
        $this->log = new Log();
        $this->producto = new Producto();
    }

    public function guardar_producto()
    {
        try {
            $model = new Producto();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario, Code 3: Paciente con DNI ya existente, Code 4: DNI no tiene 8 caracteres";
            if(isset($_POST['id_producto'])){
                $model->id_producto = $_POST['id_producto'];
            }
            $model->id_marca = $_POST['id_marca'];
            $model->id_modelo = $_POST['id_modelo'];
            $model->producto_nombre = $_POST['producto_nombre'];
            $model->producto_precio = $_POST['producto_precio'];
            if(empty($_POST['producto_descripcion'])){
                $model->producto_descripcion = "";
            } else {
                $model->producto_descripcion = $_POST['producto_descripcion'];
            }
            $model->producto_talla = $_POST['producto_talla'];
            $model->producto_foto = $_POST['producto_foto'];
            $model->producto_estado = $_POST['producto_estado'];
            $result = $this->producto->guardar_producto($model);
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function listar_productos()
    {
        $productos_ = [];
        try {
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            if(isset($_POST['producto_estado'])){
                $productos = $this->producto->listar_productos($_POST['producto_estado']);
            } else {
                $productos = $this->producto->listar_productos_todo();
            }
            $result = 1;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response, "data" => $productos);
        echo json_encode($data);
    }

    public function guardar_galeria()
    {
        try {
            $model = new Producto();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario, Code 3: Paciente con DNI ya existente, Code 4: DNI no tiene 8 caracteres";
            if(isset($_POST['id_galeria'])){
                $model->id_galeria = $_POST['id_galeria'];
                $result = $this->producto->guardar_galeria($model);
            } else {
                $model->id_producto = $_POST['id_producto'];
                $model->galeria_foto = $_POST['galeria_foto'];
                $result = $this->producto->guardar_galeria($model);
            }
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function listar_galeria()
    {
        $productos_ = [];
        try {
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $productos = $this->producto->listar_galeria($_POST['id_producto']);
            $result = 1;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response, "data" => $productos);
        echo json_encode($data);
    }

    public function guardar_marca()
    {
        try {
            $model = new Producto();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario, Code 3: Paciente con DNI ya existente, Code 4: DNI no tiene 8 caracteres";
            if(isset($_POST['id_marca'])){
                $model->id_marca = $_POST['id_marca'];
            }
            $model->marca_nombre = $_POST['marca_nombre'];
            $model->marca_estado = $_POST['marca_estado'];
            $result = $this->producto->guardar_marca($model);
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function listar_marcas()
    {
        $productos_ = [];
        try {
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            if(isset($_POST['marca_estado'])){
                $productos = $this->producto->listar_marca($_POST['marca_estado']);
            } else {
                $productos = $this->producto->listar_marca_todo();
            }
            $result = 1;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response, "data" => $productos);
        echo json_encode($data);
    }

    public function guardar_modelo()
    {
        try {
            $model = new Producto();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario, Code 3: Paciente con DNI ya existente, Code 4: DNI no tiene 8 caracteres";
            if(isset($_POST['id_modelo'])){
                $model->id_modelo = $_POST['id_modelo'];
            }
            $model->modelo_nombre = $_POST['modelo_nombre'];
            $model->modelo_estado = $_POST['modelo_estado'];
            $result = $this->producto->guardar_modelo($model);
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function listar_modelos()
    {
        try {
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            if(isset($_POST['modelo_estado'])){
                $productos = $this->producto->listar_modelo($_POST['modelo_estado']);
            } else {
                $productos = $this->producto->listar_modelo_todo();
            }
            $result = 1;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response, "data" => $productos);
        echo json_encode($data);
    }
}
