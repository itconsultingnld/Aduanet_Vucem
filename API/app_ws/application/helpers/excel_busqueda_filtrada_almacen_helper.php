<?php
include_once('xlsxwriter.class.php');

function excel_busqueda_filtrada_almacen($inspecciones)
{
    date_default_timezone_set('America/Matamoros');

    $fecha_actual_completa = date('Ymd');

    $CI = &get_instance();

    $filename = 'Reporte_' . $fecha_actual_completa . '.xlsx';

    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Folio' => 'string',
        'Fecha' => 'string',
        'Hora' => 'string',
        "Tiempo inspeccion" => 'string',
        'Tipo' => 'string',
        'Guardia' => 'string',
        'Destino' => 'string',
        'Cliente' => 'string',
        'Línea Semi' => 'string',
        'Marca Semi' => 'string',
        'Año Semi' => 'integer',
        'No Eco Semi' => 'string',
        'No. Serie Semi' => 'string',
        'Tipo Semi' => 'string',
        'Sellos' => 'string'
    );
    $writer = new XLSXWriter();
    $writer->writeSheetHeader('Inspecciones', $header);
    $array = array();

    foreach ($inspecciones as $row) {
        $array[0] = $row['Folio'];
        $array[1] = $row['FechaInspeccion'];
        $array[2] = $row['HoraInspeccion'];
        $array[3] = $row['tiempo_inspeccion'];
        $array[4] = $row['TipoMovimiento'];
        $array[5] = $row['nombreUsuarioInspCompleto'];
        $array[6] = $row['Procedencia'];
        $array[7] = $row['Cliente'];
        $array[8] = $row['CompaniaSemirremolque'];
        $array[9] = $row['MarcaSemirremolque'];
        $array[10] = $row['AnioSemirremolque'];
        $array[11] = $row['NumEconSemi'];
        $array[12] = $row['NumSerieSemi'];
        $array[13] = $row['TipoSemirremolque'];
        $array[14] = $row['sellosSemi'];
        $writer->writeSheetRow('Inspecciones', $array);
    }

    $writer->writeToStdOut();
    exit();
}
