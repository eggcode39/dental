<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/05/2021
 * Time: 19:00
 */
class Cita{
    private $pdo;
    private $log;
    public function __construct(){
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }

    public function registrar_cita($model){
        try{
            $sql = "insert into cita (id_paciente, cita_fecha, cita_hora, cita_comentarios, cita_estado) values (?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_paciente,
                $model->cita_fecha,
                $model->cita_hora,
                "",
                0
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function atender_cita($model){
        try{
            $sql = "update cita set cita_comentarios = ?, cita_estado = 1 where id_cita = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->cita_comentarios,
                $model->id_cita
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_citas_dias($fecha){
        try{
            $sql = "select * from cita c inner join paciente p on c.id_paciente = p.id_paciente where c.cita_fecha = ? and c.cita_estado = 0";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_citas_dias_todo($fecha){
        try{
            $sql = "select * from cita c inner join paciente p on c.id_paciente = p.id_paciente where c.cita_fecha = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}
