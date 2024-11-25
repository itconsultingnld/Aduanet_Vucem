<?php
include_once('xlsxwriter.class.php');


function exportarListaFoliosAlmacen($get)
{
    date_default_timezone_set('America/Matamoros');

    $fecha_actual = date('Y-m-d');
    $fecha_actual_completa = date('Ymd');

    $CI = &get_instance();
    $CI->load->database();

    $folios = $get['Folios'];
    $es_transportista = $get['es_transportista'];
    if ($folios == '') {
        $folios = "0";
    }
    $queryInspeccion = $CI->db->query('select * from vw_inspecciones where inspeccionID in (' . $folios . ') order by FechaInspeccion desc, HoraInspeccion desc');

    $filename = 'Reporte_Almacen_' . $fecha_actual_completa . '.xlsx';

    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Folio',
        'Fecha',
        'Hora',
        'Tiempo inspección',
        'Tipo',
        'Nombre de quien inspecciona',
        'Destino',
        'Cliente',
        'Línea semirremolque',
        'Marca semirremolque',
        'Año semirremolque',
        'No. económico semirremolque',
        'No. serie semirremolque',
        'Tipo semirremolque',
        'Sellos',
        'Descripción del producto',
        'Peso',
        'Piezas',
        'No. de tarimas',
        'Factura/Orden de carga',
        'Estatus'
    );
    if ($es_transportista == 3) {
        $header['No. GPS'] = 'string';
        $header['Autoriza por Monitoreo'] = 'string';
    }
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
    $row_vacio[42] = '';
    $row_vacio[43] = '';
    $row_vacio[44] = '';
    $row_vacio[45] = '';
    $row_vacio[46] = '';
    $row_vacio[47] = '';
    $row_vacio[48] = '';

    $writer->writeSheetRow('Inspecciones', array('Inspecciones en almacén'), $styles2);
    $writer->writeSheetRow('Inspecciones', $row_vacio);
    $writer->writeSheetRow('Inspecciones', array('', 'Fecha:', $fecha_actual));
    $writer->writeSheetRow('Inspecciones', $row_vacio);
    $writer->writeSheetRow('Inspecciones', $header, $styles);

    $array = array();

    if ($queryInspeccion && $queryInspeccion->num_rows() > 0) {
        foreach ($queryInspeccion->result() as $row) {
            $folio = $row->Folio;

            $array[0] = $folio;
            $array[2] = $row->FechaInspeccion;
            $array[3] = $row->HoraInspeccion;
            $array[4] = $row->tiempo_inspeccion;
            $array[5] = $row->TipoMovimiento;
            $array[6] = $row->nombreUsuarioInspCompleto;
            $array[7] = $row->Procedencia;
            $array[8] = $row->Cliente;
            $array[9] = $row->CompaniaSemirremolque;
            $array[10] = $row->MarcaSemirremolque;
            $array[11] = $row->AnioSemirremolque;
            $array[12] = $row->NumEconSemi;
            $array[13] = $row->NumSerieSemi;
            $array[14] = $row->TipoSemirremolque;
            $array[15] = $row->sellosSemi;
            $array[16] = $row->descripcion_producto;
            $array[17] = $row->peso;
            $array[18] = $row->piezas;
            $array[19] = $row->numero_tarimas;
            $array[20] = $row->factura_orden;
            $array[21] = $row->estatusSemi;
            if ($es_transportista == 3) {
                $array[22] = $row->num_gps;
                $array[23] = $row->autoriza_por_monitoreo;
            }
            $writer->writeSheetRow('Inspecciones', $array);
        }
    }


    $writer->writeToStdOut();
    exit();
}
