<?php
include_once 'xlsxwriter.class.php';

function excel_empresas()
{
    date_default_timezone_set('America/Matamoros');

    $fecha = date('d-m-Y');

    $CI = &get_instance();
    $CI->load->database();

    $query = $CI->db->query('select * from empresas where Activo = 1');

    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename('Empresas.xlsx') . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Nombre de la empresa',
        'Nombre del cliente',
        'Puesto del cliente',
        'Correo electrónico',
        'Número de licencias',
        'Teléfono',
        'Tipo de empresa'
    );
    $writer = new XLSXWriter();
    $styles = array('font' => 'Arial', 'font-size' => 10, 'font-style' => 'bold', 'fill' => '#eee', 'halign' => 'center', 'border' => 'left,right,top,bottom');
    $styles2 = array('font' => 'Arial', 'font-size' => 14, 'font-style' => 'bold');

    $row_vacio = array();
    $row_vacio[0] =  '';
    $row_vacio[1] = '';
    $row_vacio[2] = '';
    $row_vacio[3] = '';
    $row_vacio[4] = '';
    $row_vacio[5] = '';
    $row_vacio[6] = '';
    $row_vacio[7] = '';
    $row_vacio[8] = '';
    $row_vacio[9] = '';
    $row_vacio[10] = '';
    $row_vacio[11] = '';
    $row_vacio[12] = '';
    $row_vacio[13] = '';
    $row_vacio[14] = '';
    $row_vacio[15] = '';
    $row_vacio[16] = '';
    $row_vacio[17] = '';
    $row_vacio[18] = '';
    $row_vacio[19] = '';
    $row_vacio[20] = '';
    $row_vacio[21] = '';
    $row_vacio[22] = '';
    $row_vacio[23] = '';
    $row_vacio[24] = '';
    $row_vacio[25] = '';
    $row_vacio[26] = '';
    $row_vacio[27] = '';
    $row_vacio[28] = '';
    $row_vacio[29] = '';
    $row_vacio[30] = '';
    $row_vacio[31] = '';
    $row_vacio[32] = '';
    $row_vacio[33] = '';
    $row_vacio[34] = '';
    $row_vacio[35] = '';
    $row_vacio[36] = '';
    $row_vacio[37] = '';
    $row_vacio[38] = '';
    $row_vacio[39] = '';
    $row_vacio[40] = '';
    $row_vacio[41] = '';

    $writer->writeSheetRow('Empresas', array('Empresas'), $styles2);
    $writer->writeSheetRow('Empresas', $row_vacio);
    $writer->writeSheetRow('Empresas', array('', 'Fecha:', $fecha));
    $writer->writeSheetRow('Empresas', $row_vacio);
    $writer->writeSheetRow('Empresas', $header, $styles);
    $array = array();

    foreach ($query->result() as $row) {
        $array[0] = $row->nombre_empresa;
        $array[1] = $row->nombre . " " . $row->ape_pat . " " . $row->ape_mat;
        $array[2] = $row->puesto;
        $array[3] = $row->correo;
        $array[4] = $row->licencias;
        $array[5] = $row->telefono;
        switch ((int)$row->es_transportista) {
            case 0:
                $tipo = 'MAQUILADORA/FORWARDING/ALMACÉN';
                break;
            case 1:
                $tipo = 'TRANSPORTISTA';
                break;
            case 2:
                $tipo = 'BRIDGESTONE';
                break;
            case 3:
                $tipo = 'SUKARNE';
                break;
            default:
                $tipo = '';
                break;
        }
        $array[6] = $tipo;
        $writer->writeSheetRow('Empresas', $array);
    }

    $writer->writeToStdOut();
    exit();
}
