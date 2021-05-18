<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 17/05/2021
 * Time: 22:18
 */
class Producto{
    private $pdo;
    private $log;
    public function __construct(){
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }

    public function registrar_producto($model){
        try{
            $sql = "insert into producto (producto_nombre, producto_precio, producto_descripcion, producto_modelo, producto_marca, producto_talla, producto_estado) values (?,?,?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->producto_nombre,
                $model->producto_precio,
                $model->producto_descripcion,
                $model->producto_modelo,
                $model->producto_marca,
                $model->producto_talla,
                $model->producto_estado
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function registrar_foto($model){
        try{
            $sql = "insert into foto (id_producto, foto_url, foto_estado) values (?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_producto,
                $model->foto_url,
                $model->foto_estado
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_productos(){
        try{
            $sql = "select * from producto";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_fotos_producto($id_producto){
        try{
            $sql = "select * from foto where id_producto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}
