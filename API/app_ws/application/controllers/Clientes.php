<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS");
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
include APPPATH . '/third_party/jwt/JWT.php';
include APPPATH . '/third_party/jwt/BeforeValidException.php';
include APPPATH . '/third_party/jwt/ExpiredException.php';
include APPPATH . '/third_party/jwt/SignatureInvalidException.php';

use Firebase\JWT\JWT;

class Clientes extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        /* Se agregar la conexion a la base de datos a toda la clase */
        $this->load->database();
        $this->load->model("Clientes_model");
    }

    /* GET - Listado de Clientes  */
    public function clientes_get()
    {
        $idusuario = $this->uri->segment(3);
        $respuesta = $this->Clientes_model->clientes($idusuario);
        if ($respuesta["error"] === false) {
            $this->response($respuesta['registros'], 200);
        } else {
            $this->response($respuesta['mensaje'], 400);
        }
    }

    public function cliente_desactivar_put()
    {
        /* Obtiene parámetros */
        $ClienteID = $this->put("ClienteID");
        $respuesta = $this->Clientes_model->cliente_desactivar($ClienteID);
        if ($respuesta["error"] === false) {
            $this->response($respuesta, 200);
        } else {
            $this->response($respuesta, 400);
        }
    }

    /* POST - Inserta registro en Tabla Clientes */
    public function InsertarClientes_post()
    {
        $datos_cliente = $this->post();
        $this->form_validation->set_data($datos_cliente);
        if ($this->form_validation->run('InsertarClientes_post')) {
            $respuesta = $this->Clientes_model->InsertarClientes($datos_cliente);
            if ($respuesta["error"] === false) {
                $this->response($respuesta['mensaje'], 200);
            } else {
                $this->response($respuesta['mensaje'], 400);
            }
        } else {
            $this->response($this->form_validation->get_errores_string(), "ERROR_VALIDACION_FORMULARIO");
        }
    }

    /* GET Cliente por ID */
    public function clientePorID_get()
    {
        $idusuario = $this->uri->segment(3);
        $respuesta = $this->Clientes_model->clientePorID($idusuario);
        if ($respuesta["error"] === false) {
            $this->response($respuesta['registros'], 200);
        } else {
            $this->response($respuesta['mensaje'], 400);
        }
    }

    /* PUT - Modificar datos en la tabla Clientes */
    public function actualizarClientes_put()
    {
        $datos_cliente = $this->put();
        $idusuario = (int) $this->uri->segment(3);
        $this->form_validation->set_data($datos_cliente);
        if ($this->form_validation->run('actualizarClientes_put')) {
            $respuesta = $this->Clientes_model->actualizarClientes($datos_cliente, $idusuario);
            if ($respuesta["error"] === false) {
                $this->response($respuesta, 200);
            } else {
                $this->response($respuesta, 400);
            }
        } else {
            $this->response($this->form_validation->get_errores_objeto(), "ERROR_VALIDACION_FORMULARIO");
        }
    }

    /* GET - Listado de Clientes por popularidad */
    public function clientes_pop_get()
    {
        $empresa_id = (int)$this->uri->segment(3);
        $respuesta = $this->Clientes_model->clientes_pop($empresa_id);
        if ($respuesta["error"] === false) {
            $this->response($respuesta['registros'], 200);
        } else {
            $this->response($respuesta['mensaje'], 400);
        }
    }

    public function excel_post()
    {
        $this->load->helper('excel_clientes');
        excel_clientes($this->post());
    }
}
