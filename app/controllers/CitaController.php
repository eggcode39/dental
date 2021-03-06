<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/05/2021
 * Time: 19:00
 */
require 'app/models/Cita.php';
require 'app/models/Paciente.php';
class CitaController{
    private $log;
    private $cita;
    private $paciente;

    public function __construct()
    {
        $this->log = new Log();
        $this->cita = new Cita();
        $this->paciente = new Paciente();
    }

    public function registrar_cita(){
        try{
            $cita_registrada = [];
            $model = new Cita();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error";
            $mt = microtime(true);
            if(isset($_POST['id_paciente']) && isset($_POST['cita_fecha']) && isset($_POST['cita_hora'])){
                $model->id_paciente = $_POST['id_paciente'];
                $model->cita_fecha = $_POST['cita_fecha'];
                $model->cita_hora = $_POST['cita_hora'];
                $model->cita_mt = $mt;
                $result = $this->cita->registrar_cita($model);
            } else {
                $result = 6;
                $message = "Code 6: Datos No Recibidos";
            }

            if($result == 1){
                $cita_registrada = $this->cita->buscar_cita_paciente_mt($mt);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message, "cita_registrada" => $cita_registrada);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function registrar_cita_dni(){
        try{
            $cita_registrada = [];
            $model = new Cita();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error";
            $mt = microtime(true);
            if(isset($_POST['dni']) && isset($_POST['cita_fecha']) && isset($_POST['cita_hora'])){
                $paciente = $this->cita->buscar_paciente_dni($_POST['dni']);
                if(isset($paciente->id_paciente)){
                    $model->id_paciente = $paciente->id_paciente;
                    $model->cita_fecha = $_POST['cita_fecha'];
                    $model->cita_hora = $_POST['cita_hora'];
                    $model->cita_mt = $mt;
                    $result = $this->cita->registrar_cita($model);
                } else {
                    $model_p = new Paciente();
                    $model_p->paciente_nombre = 'Consulta';
                    $model_p->paciente_apellido = 'Ambulatoria';
                    $model_p->paciente_dni = $_POST['dni'];
                    $model_p->paciente_telefono = '999999999';
                    $model_p->paciente_correo = 'no-correo@gmail.com';
                    $model_p->paciente_imagen_url = "https://guabba.com/dental/media/user.jpg";
                    $result_p = $this->paciente->registrar_paciente($model_p);
                    if($result_p == 1){
                        $paciente = $this->cita->buscar_paciente_dni($_POST['dni']);

                        $model->id_paciente = $paciente->id_paciente;
                        $model->cita_fecha = $_POST['cita_fecha'];
                        $model->cita_hora = $_POST['cita_hora'];
                        $model->cita_mt = $mt;
                        $result = $this->cita->registrar_cita($model);
                    }
                }
            } else {
                $result = 6;
                $message = "Code 6: Datos No Recibidos";
            }

            if($result == 1){
                $cita_registrada = $this->cita->buscar_cita_paciente_mt($mt);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message, "cita_registrada" => $cita_registrada);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function listar_citas_dia(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            if(isset($_POST['fecha'])){
                $datos = $this->cita->listar_citas_dias($_POST['fecha']);
                $result = 1;
            } else {
                $datos = [];
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

    public function listar_citas_dia_todo(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            if(isset($_POST['fecha'])){
                $datos = $this->cita->listar_citas_dias_todo($_POST['fecha']);
                $result = 1;
            } else {
                $datos = [];
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

    public function atender_cita(){
        try{
            $model = new Cita();
            //If All OK, the message does not change
            $message = "Code 1: Ok, Code 2: Error";
            if(isset($_POST['id_cita']) && isset($_POST['cita_comentarios'])){
                $model->id_cita = $_POST['id_cita'];
                $model->cita_comentarios = $_POST['cita_comentarios'];
                $result = $this->cita->atender_cita($model);
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

}
