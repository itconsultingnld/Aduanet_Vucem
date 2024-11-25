<?php
include_once 'xlsxwriter.class.php';

function excel_tractos_patio($datos)
{
    date_default_timezone_set('America/Matamoros');

    $fecha = date('d-m-Y');
    $fecha_actual_completa = date('Ymd');
    $CI = &get_instance();
    $CI->load->database();
    
    $empresa_id = $datos['empresa_id'];
    $query = $CI->db->query('select * from vw_tractos_patio where empresa_id = '. $empresa_id.' order by fechaInspeccion DESC, horaInspeccion DESC');

    $respuesta = $query->result();

    $tractos = array();
    for ($i = 0; $i < count($respuesta); $i++) {
        $tractoID = $respuesta[$i]->tractocamionID;
        if (in_array($tractoID, $tractos)) {
            array_splice($respuesta, $i, 1);
            $i--;
        } else {
            array_push($tractos, $tractoID);
        }
    }

    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename("") . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Núm econ tractocamión',
        'Placas',
        'Marca',
        'Línea transportista',
        'Fecha',
        'Hora',
        'Tipo movimiento',
        'Cliente',
        'Operador',
        'Folio'      
    );
    $writer = new XLSXWriter();
    $styles = array( 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom');
    $styles2 = array( 'font'=>'Arial','font-size'=>14,'font-style'=>'bold');
    
    $row_vacio = array();
    $row_vacio[0] =  '';
    $row_vacio[1] = '';
    $row_vacio[2] = '';
    $row_vacio[3] = '';
    $row_vacio[4] = '';
    $row_vacio[5]= '';
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

    $writer->writeSheetRow('tractos_patio', array('Tractocamiones en patio'), $styles2);
    $writer->writeSheetRow('tractos_patio', $row_vacio);
    $writer->writeSheetRow('tractos_patio', array('','Fecha:', $fecha));
    $writer->writeSheetRow('tractos_patio', $row_vacio);
    $writer->writeSheetRow('tractos_patio', $header, $styles);
    $array = array();

    foreach ($respuesta as $row) {
        $array[0] = $row->numEconTracto;
        $array[1] = $row->numPlacas;
        $array[2] = $row->marca_tracto;
        $array[3] = $row->empresaProveedor;
        $array[4] = $row->fechaInspeccion;
        $array[5] = $row->horaInspeccion;
        $array[6] = $row->Nombre;
        $array[7] = $row->empresaCliente;
        $array[8] = $row->nombreOperador;
        $array[9] = $row->folio;
        $writer->writeSheetRow('tractos_patio', $array);
    }

    $writer->writeToStdOut();
    exit();
}
