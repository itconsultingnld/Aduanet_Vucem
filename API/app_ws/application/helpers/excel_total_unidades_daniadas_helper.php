<?php
include_once 'xlsxwriter.class.php';

function excel_total_unidades_daniadas($datos)
{
    date_default_timezone_set('America/Matamoros');

    $fecha = date('d-m-Y');
    $fecha_actual_completa = date('Ymd');
    $CI = &get_instance();
    $CI->load->database();
    
    $empresa_id = $datos['empresa_id'];
    $query = $CI->db->query('select * from vw_unidades_daniadas where empresa_id ='.$empresa_id);

    $respuesta = $query->result();

    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename("") . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Tipo',
        'Número económico',
        'Línea',
        'Fecha',
        'Hora',
        'Daño(s)' 
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

    $writer->writeSheetRow('unidades_daniadas', array('Unidades dañadas'), $styles2);
    $writer->writeSheetRow('unidades_daniadas', array('','','','','','T = Tractocamión',));
    $writer->writeSheetRow('unidades_daniadas', array('','Fecha:', $fecha,'','','S = Semirremolque'));
    $writer->writeSheetRow('unidades_daniadas', $row_vacio);
    $writer->writeSheetRow('unidades_daniadas', $header, $styles);
    $array = array();

    foreach ($respuesta as $row) {
        $danios = '';
        if ($row->tipo == 'T') {
            if ($row->espejoLatIzq == 'ROTO') {
                $danios .= 'espejoLatIzq, ';
            } 
            if ($row->espejoLatDer == 'ROTO') {
                $danios .= 'espejoLatDer, ';
            } 
            if ($row->llantasBajaPresion == '1') {
                $danios .= 'llantasBajaPresion, ';
            } 
            foreach ($row as $tc=>$cmp) {
                if (contiene($tc,'TC_')) {
                    if ($cmp == 'NC') {
                        $danios .= $tc.", ";
                    }
                }
            }
        }else if ($row->tipo == 'S') {
            foreach ($row as $sr=>$cmp) {
                if (contiene($sr,'SR_')) {
                    if ($cmp == 'NC') {
                        $danios .= $sr.", ";
                    }
                }
            }
        }
        $danios = daniosFormato($danios);
        $row->danios = rtrim($danios,", ");
    }

    foreach ($respuesta as $row) {
        $array[0] = $row->tipo;
        $array[1] = $row->num_eco;
        $array[2] = $row->linea;
        $array[3] = $row->fecha;
        $array[4] = date('H:i', strtotime($row->hora));
        $array[5] = $row->danios;
        $writer->writeSheetRow('unidades_daniadas', $array);
    }

    $writer->writeToStdOut();
    exit();
}
