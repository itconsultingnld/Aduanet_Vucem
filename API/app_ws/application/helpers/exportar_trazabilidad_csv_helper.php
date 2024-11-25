<?php
include_once 'xlsxwriter.class.php';

function exportarTrazabilidad($trazabilidadEncontrada)
{
    date_default_timezone_set('America/Matamoros');


    $fecha = date('d-m-Y');

    $CI = &get_instance();
    $CI->load->database();


    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename('Reporte_Trazabilidad.xlsx') . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Tipo movimiento',
        'Cliente',
        'Fecha entrada',
        'Hora entrada',
        'Tractocamión de entrada',
        'Línea transportista de entrada',
        'Operador de entrada',
        'Semiremolque',
        'Línea semiremolque',
        'Placas semiremoque',
        'Fecha salida',
        'Hora salida',
        'Tractocamión de salida',
        'Línea transportista de salida',
        'Operador de salida'
    );
    $writer = new XLSXWriter();
    $styles = array( 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom');
    $styles2 = array( 'font'=>'Arial','font-size'=>14,'font-style'=>'bold',  'halign'=>'center');
    
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


    $writer->writeSheetRow('Trazabilidad', array('Reporte de trazabilidad'), $styles2);
    $writer->writeSheetRow('Trazabilidad', $row_vacio);
    $writer->writeSheetRow('Trazabilidad', array('','Fecha:', $fecha));
    $writer->writeSheetRow('Trazabilidad', $row_vacio);
    $writer->writeSheetRow('Trazabilidad', $header, $styles);
    $array = array();
  

    foreach ($trazabilidadEncontrada as $row) {

        $array[0] = $row['TipoMovimiento'];
        $array[1] = $row['Cliente'];
        $array[2] = $row['FechaEntrada'];
        $array[3] = $row['HoraEntrada'];
        $array[4] = $row['NumEconTractoEntrada'];
        $array[5] = $row['ProveedorEntrada'];
        $array[6] = $row['OperadorEntrada'];
        $array[7] = $row['numEconSemi'];
        $array[8] = $row['linea_semi'];
        $array[9] = $row['placasSemi'];
        $array[10] = $row['FechaSalida'];
        $array[11] = $row['HoraSalida'];
        $array[12] = $row['NumEconTractoSalida'];
        $array[13] = $row['ProveedorSalida'];
        $array[14] = $row['OperadorSalida'];
        $writer->writeSheetRow('Trazabilidad', $array);
    }


    $writer->writeToStdOut();
    exit();
}
