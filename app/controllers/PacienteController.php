<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/05/2021
 * Time: 18:44
 */
require 'app/models/Paciente.php';
class PacienteController{
    private $log;
    private $paciente;

    public function __construct()
    {
        $this->log = new Log();
        $this->paciente = new Paciente();
    }

    public function registrar_paciente(){
        try{
            $model = new Paciente();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error al crear Usuario, Code 3: Paciente con DNI ya existente, Code 4: DNI no tiene 8 caracteres";
            if(isset($_POST['paciente_nombre']) && isset($_POST['paciente_apellido']) && isset($_POST['paciente_dni'])){
                if(strlen($_POST['paciente_dni']) == 8){
                    $paciente = $this->paciente->buscar_paciente_dni($_POST['paciente_dni']);
                    if(isset($paciente->paciente_dni)){
                        $result = 3;
                    } else {
                        $model->paciente_nombre = $_POST['paciente_nombre'];
                        $model->paciente_apellido = $_POST['paciente_apellido'];
                        $model->paciente_dni = $_POST['paciente_dni'];
                        $result = $this->paciente->registrar_paciente($model);
                    }
                } else {
                    $result = 4;
                }
            } else {
                $result = 6;
                $message = "Code 6: Datos No Recibidos";
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function listar_pacientes(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $datos = $this->paciente->listar_pacientes();
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response, "data" => $datos);
        echo json_encode($data);
    }

    public function listar_citas_paciente(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            if(isset($_POST['id_paciente'])){
                $datos = $this->paciente->listar_citas_pendientes_paciente($_POST['id_paciente']);
                $result = 1;
            } else {
                $result = 6;
                $message = "Code 6: Datos No Recibidos";
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response, "data" => $datos);
        echo json_encode($data);
    }

    public function listar_atenciones_paciente(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            if(isset($_POST['id_paciente'])){
                $datos = $this->paciente->listar_citas_atendidas_paciente($_POST['id_paciente']);
                $result = 1;
            } else {
                $result = 6;
                $message = "Code 6: Datos No Recibidos";
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response, "data" => $datos);
        echo json_encode($data);
    }

}
