<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS");
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/third_party/jwt/JWT.php';
include APPPATH . '/third_party/jwt/BeforeValidException.php';
include APPPATH . '/third_party/jwt/ExpiredException.php';
include APPPATH . '/third_party/jwt/SignatureInvalidException.php';

class Convertidor extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        /* Se agregar la conexion a la base de datos a toda la clase */
        /* $this->load->database(); */
        $this->load->model("Convertidor_model");
    }

    /* POST - Convertidor a Vucem */
    public function convertir_post()
    {
        $archivo = $this->post('archivo');
        $this->Convertidor_model->convertir($archivo);
    }

    /* POST - Revisar tamaño de archivo */
    public function revisar_tamanio_post()
    {
        $archivo = $this->post('archivo');
        $respuesta = $this->Convertidor_model->revisar_tamanio($archivo);
        if ($respuesta["error"] === false) {
            $this->response($respuesta, 200);
        } else {
            $this->response($respuesta, 400);
        }
    }
}
