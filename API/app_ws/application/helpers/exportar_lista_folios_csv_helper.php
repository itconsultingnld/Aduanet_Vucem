<?php
include_once('xlsxwriter.class.php');



function exportarListaFolios($get)
{
    date_default_timezone_set('America/Matamoros');

    $fecha_actual_completa = date('d-m-Y');

    $CI = &get_instance();
    $CI->load->database();

    $folios = $get['Folios'];
    $es_transportista = $get['es_transportista'];
    if ($folios == '') {
        $folios = "0";
    }
    $queryInspeccion = $CI->db->query('select * from vw_inspecciones where inspeccionID in (' . $folios . ') order by FechaInspeccion DESC, HoraInspeccion DESC');

    $filename = 'Reporte_' . $fecha_actual_completa . '.xlsx';

    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Folio',
        'Tipo de inspección',
        'Fecha',
        'Hora',
        'Tiempo inspección',
        'Tipo',
        'Guardia',
        'Operador',
        'Teléfono Operador',
        'No. licencia',
        'Vigencia licencia',
        'Procedencia',
        'Cliente',
        'Línea Transportista',
        'TC No. Eco',
        'TC No. Placas',
        'Tarjeta circulación',
        'TC marca',
        'TC nivel combustible',
        'Línea Semi',
        'Marca Semi',
        'Año Semi',
        'No Eco Semi',
        'No. Serie Semi',
        'Tipo Semi',
        'Temp Semi',
        'Nivel combustible Semi',
        'Sellos',
        'Línea Semi 2',
        'Marca Semi 2',
        'Año Semi 2',
        'No. Eco Semi 2',
        'No. Serie Semi 2',
        'Tipo Semi 2',
        'Temp Semi 2',
        'Nivel Combustible Semi 2',
        'Sellos 2',
        'Comentarios',
    );
    if ($es_transportista == 3) {
        $header['No.Gafete'] = 'string';
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

    $writer->writeSheetRow('Control de accesos', array('Control de accesos'), $styles2);
    $writer->writeSheetRow('Control de accesos', $row_vacio);
    $writer->writeSheetRow('Control de accesos', array('', 'Fecha:', $fecha_actual_completa));
    $writer->writeSheetRow('Control de accesos', $row_vacio);
    $writer->writeSheetRow('Control de accesos', $header, $styles);
    
    $array = array();


    foreach ($queryInspeccion->result() as $row) {
        $folio = $row->Folio;

        $array[0] = $folio;
        $array[1] = $row->TipoInspeccion;
        $array[2] = $row->FechaInspeccion;
        $array[3] = $row->HoraInspeccion;
        $array[4] = $row->tiempo_inspeccion;
        $array[5] = $row->TipoMovimiento;
        $array[6] = $row->nombreUsuarioInspCompleto;
        $array[7] = $row->nombreOpCompleto;
        $array[8] = $row->telefono_ope;
        $array[9] = $row->NumeroLicencia;
        $array[10] = $row->FechaVigencia;
        $array[11] = $row->Procedencia;
        $array[12] = $row->Cliente;
        $array[13] = $row->Proveedor;
        $array[14] = $row->NumEconomicoTracto;
        $array[15] = $row->NumPlacasTracto;
        $array[16] = $row->TarjetaCircTracto;
        $array[17] = $row->MarcaTracto;
        $array[18] = $row->nivelCombustTracto;
        $array[19] = $row->CompaniaSemirremolque;
        $array[20] = $row->MarcaSemirremolque;
        $array[21] = $row->AnioSemirremolque;
        $array[22] = $row->NumEconSemi;
        $array[23] = $row->NumSerieSemi;
        $array[24] = $row->TipoSemirremolque;
        $array[25] = $row->TemperaturaSemi;
        $array[26] = $row->NivelCombustSemi;
        $array[27] = $row->sellosSemi;
        $array[28] = $row->CompaniaSemirremolque2;
        $array[29] = $row->MarcaSemirremolque2;
        $array[30] = $row->AnioSemirremolque2;
        $array[31] = $row->NumEconSemi2;
        $array[32] = $row->NumSerieSemi2;
        $array[33] = $row->TipoSemirremolque2;
        $array[34] = $row->TemperaturaSemi2;
        $array[35] = $row->NivelCombustSemi2;
        $array[36] = $row->sellosSemi2;
        $array[37] = $row->ComentariosInspeccion;
        if ($es_transportista == 3) {
            $array[38] = $row->numControlOp;
            $array[39] = $row->num_gps;
            $array[40] = $row->autoriza_por_monitoreo;
        }
        $writer->writeSheetRow('Control de accesos', $array);
    }


    $writer->writeToStdOut();
    exit();
}
