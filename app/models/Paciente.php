<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/05/2021
 * Time: 18:45
 */
class Paciente{
    private $pdo;
    private $log;
    public function __construct(){
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }

    public function registrar_paciente($model){
        try{
            $sql = "insert into paciente (paciente_nombre, paciente_apellido, paciente_dni, paciente_telefono, paciente_correo, paciente_imagen_url) values (?,?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->paciente_nombre,
                $model->paciente_apellido,
                $model->paciente_dni,
                $model->paciente_telefono,
                $model->paciente_correo,
                $model->paciente_imagen_url
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_pacientes(){
        try{
            $sql = "select * from paciente";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function buscar_paciente_dni($dni){
        try{
            $sql = "select * from paciente where paciente_dni = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$dni]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_citas_pendientes_paciente($id_paciente){
        try{
            $sql = "select * from cita where id_paciente = ? and cita_estado = 0";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_paciente]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_citas_paciente_todo($id_paciente){
        try{
            $sql = "select * from cita where id_paciente = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_paciente]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_citas_atendidas_paciente($id_paciente){
        try{
            $sql = "select * from cita where id_paciente = ? and cita_estado = 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_paciente]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}
