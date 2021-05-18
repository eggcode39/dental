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

    public function registrar_producto()
    {
        try {
            $model = new Producto();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario, Code 3: Paciente con DNI ya existente, Code 4: DNI no tiene 8 caracteres";
            $model->producto_nombre = $_POST['producto_nombre'];
            $model->producto_precio = $_POST['producto_precio'];
            $model->producto_descripcion = $_POST['producto_descripcion'];
            $model->producto_modelo = $_POST['producto_modelo'];
            $model->producto_marca = $_POST['producto_marca'];
            $model->producto_talla = $_POST['producto_talla'];
            $model->producto_estado = $_POST['producto_estado'];
            $result = $this->producto->registrar_producto($model);
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function registrar_foto()
    {
        try {
            $model = new Producto();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario, Code 3: Paciente con DNI ya existente, Code 4: DNI no tiene 8 caracteres";
            $model->id_producto = $_POST['id_producto'];
            $model->foto_url = $_POST['foto_url'];
            $model->foto_estado = $_POST['foto_estado'];
            $result = $this->producto->registrar_foto($model);
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
            $productos = $this->producto->listar_productos();
            foreach ($productos as $p){
                $fotos = $this->producto->listar_fotos_producto($p->id_producto);
                $productos_[] = array(
                    "id_producto" => $p->id_producto,
                    "producto_nombre" => $p->producto_nombre ?? "",
                    "producto_precio" => $p->producto_precio ?? "",
                    "producto_descripcion" => $p->producto_descripcion ?? "",
                    "producto_modelo" => $p->producto_modelo ?? "",
                    "producto_marca" => $p->producto_marca ?? "",
                    "producto_talla" => $p->producto_talla ?? "",
                    "producto_estado" => $p->producto_estado ?? "",
                    "producto_fotos" => $fotos
                );
            }
            $result = 1;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result, "message" => $message);
        $data = array("result" => $response, "data" => $productos_);
        echo json_encode($data);
    }
}
