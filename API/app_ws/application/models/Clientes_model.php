<?php
class Clientes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function clientes($idusuario)
    {
        $where = array('Activo' => 1, 'empresa_id' => $idusuario);
        $query = $this->db->select("*")->from("clientes")->where($where)->get();
        if ($query->num_rows() >= 0) {
            $registros = $query->result();
            foreach ($registros as $row) {
                $row->ClienteID = (int) $row->ClienteID;
                $row->Activo = (int) $row->Activo;
            }
            $respuesta = array(
                'error' => false,
                'registros' => $registros,
            );
        } else {
            $respuesta = array(
                'mensaje' => 'Error en datos',
                'error' => true
            );
        }
        return $respuesta;
    }

    public function InsertarClientes($datos)
    {
        $data_limpia = array(
            'empresaCliente' => $datos['empresaCliente'],
            'nombreCliente' => $datos['nombreCliente'],
            'apePatCliente' => $datos['apePatCliente'],
            'apeMatCliente' => $datos['apeMatCliente'],
            'puestoCliente' => $datos['puestoCliente'],
            'correoCliente' => $datos['correoCliente'],
            'numTelCliente' => $datos['numTelCliente'],
            'empresa_id' => (int) $datos['empresa_id'],
            'Activo' => 1
        );
        $this->db->trans_begin();
        $insercion = $this->db->insert('clientes', $data_limpia);
        /* verificacion de la transaccion */
        if ($this->db->trans_status() === false) {
            $respuesta = array(
                'mensaje' => 'Error en insercion.',
                'error' => true
            );
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $respuesta = array(
                'mensaje' => 'Se inserto el registro',
                'error' => false
            );
        }
        return $respuesta;
    }

    public function clientePorID($idusuario)
    {
        $query = $this->db->select("*")->from("clientes")->where('ClienteID', $idusuario)->get();
        if ($query->num_rows() >= 0) {
            $respuesta = array(
                'registros' => $query->row(),
                'error' => false
            );
        } else {
            $respuesta = array(
                'registros' => $query->row(),
                'error' => false
            );
        }
        return $respuesta;
    }

    public function actualizarClientes($datos, $idusuario)
    {
        $data_usuario = array(
            'empresaCliente' => $datos['empresaCliente'],
            'nombreCliente' => $datos['nombreCliente'],
            'apePatCliente' => $datos['apePatCliente'],
            'apeMatCliente' => $datos['apeMatCliente'],
            'puestoCliente' => $datos['puestoCliente'],
            'correoCliente' => $datos['correoCliente'],
            'numTelCliente' => $datos['numTelCliente'],
        );
        $this->db->trans_begin();
        /* se actualiza la tabla */
        $this->db->where('ClienteID', $idusuario)->set($data_usuario)->update('clientes');
        if ($this->db->trans_status() === false) {
            $respuesta = array(
                'mensaje' => 'Error en actualizacion',
                'error' => true
            );
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $respuesta = array(
                'mensaje' => 'Se actualizo el registro',
                'error' => false
            );
        }
        return $respuesta;
    }

    public function cliente_desactivar($ClienteID)
    {
        $data_device = array(
            'Activo' => 0,
        );
        $this->db->trans_begin();

        /* se actualiza la tabla */

        $this->db->where('ClienteID', $ClienteID)->set($data_device)->update('clientes');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $respuesta = array(
                'error' => true,
                'mensaje' => 'Error en actualizacion',
            );
        } else {
            $this->db->trans_commit();

            $respuesta = array(
                'cambio' => true,
                'error' => false,
                'mensaje' => 'Actualizado correctamente',
            );
        }
        return $respuesta;
    }

    public function clientes_pop($empresa_id)
    {
        $query = $this->db->query("SELECT t.*, COUNT(ins.inspeccionID) AS conteo FROM clientes t LEFT JOIN inspecciones ins ON t.ClienteID = ins.ClienteID WHERE t.activo = 1 AND t.empresa_id = " . $empresa_id . " GROUP BY t.ClienteID ORDER BY conteo DESC, empresaCliente");
        if ($query->num_rows() >= 0) {
            $registros = $query->result();
            foreach ($registros as $row) {
                $row->ClienteID = (int) $row->ClienteID;
                $row->Activo = (int) $row->Activo;
            }
            $respuesta = array(
                'registros' => $registros,
                'error'=> false
            );
        } else {
            $respuesta = array(
                'mensaje' => 'Error en datos',
                'error' => true
            );
        }
        return $respuesta;
    }
}
