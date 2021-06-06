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

    public function guardar_producto($model){
        try{
            if(isset($model->id_producto)){
                $sql = "update producto set id_marca = ?, id_modelo = ?, producto_nombre = ?, producto_precio = ?, producto_descripcion = ?, producto_talla = ?, producto_foto = ?, producto_estado = ? where id_producto = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_marca,
                    $model->id_modelo,
                    $model->producto_nombre,
                    $model->producto_precio,
                    $model->producto_descripcion,
                    $model->producto_talla,
                    $model->producto_foto,
                    $model->producto_estado,
                    $model->id_producto
                ]);
            } else {
                $sql = "insert into producto (id_marca, id_modelo, producto_nombre, producto_precio, producto_descripcion, producto_talla, producto_foto, producto_estado) values (?,?,?,?,?,?,?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_marca,
                    $model->id_modelo,
                    $model->producto_nombre,
                    $model->producto_precio,
                    $model->producto_descripcion,
                    $model->producto_talla,
                    $model->producto_foto,
                    $model->producto_estado
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_productos($producto_estado){
        try{
            $sql = "select * from producto p inner join marca m on p.id_marca = m.id_marca inner join modelo m2 on p.id_modelo = m2.id_modelo where p.producto_estado = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$producto_estado]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_productos_todo(){
        try{
            $sql = "select * from producto p inner join marca m on p.id_marca = m.id_marca inner join modelo m2 on p.id_modelo = m2.id_modelo";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function guardar_galeria($model){
        try{
            if(isset($model->id_galeria)){
                $sql = "delete from galeria where id_galeria = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_galeria
                ]);
            } else {
                $sql = "insert into galeria (id_producto, galeria_foto) values (?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_producto,
                    $model->galeria_foto
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_galeria($id_producto){
        try{
            $sql = "select * from galeria where id_producto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function guardar_marca($model){
        try{
            if(isset($model->id_marca)){
                $sql = "update marca set marca_nombre = ?, marca_estado = ? where id_marca = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->marca_nombre,
                    $model->marca_estado,
                    $model->id_marca
                ]);
            } else {
                $sql = "insert into marca (marca_nombre, marca_estado) values (?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->marca_nombre,
                    $model->marca_estado
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_marca($marca_estado){
        try{
            $sql = "select * from marca where marca_estado = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$marca_estado]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_marca_todo(){
        try{
            $sql = "select * from marca";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function guardar_modelo($model){
        try{
            if(isset($model->id_modelo)){
                $sql = "update modelo set modelo_nombre = ?, modelo_estado = ? where id_modelo = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->modelo_nombre,
                    $model->modelo_estado,
                    $model->id_modelo
                ]);
            } else {
                $sql = "insert into modelo (modelo_nombre, modelo_estado) values (?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->modelo_nombre,
                    $model->modelo_estado
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_modelo($modelo_estado){
        try{
            $sql = "select * from modelo where modelo_estado = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$modelo_estado]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_modelo_todo(){
        try{
            $sql = "select * from modelo";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}
