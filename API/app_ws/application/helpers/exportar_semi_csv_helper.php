<?php
include_once('xlsxwriter.class.php');


function exportarSemi($get)
{
    $CI = &get_instance();
    $CI->load->database();

    $semi = $get['Semi'];
    $queryInspeccion = $CI->db->get_where('vw_inspecciones', array('NumEconSemi' => $semi));
    $filename = 'Reporte_' . $semi . '.xlsx';

    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $header = array(
        'Folio' => 'string',
        'Tipo de inspección' => 'string',
        'Fecha' => 'string',
        'Hora' => 'string',
        'Tipo' => 'string',
        'Guardia' => 'string',
        'Operador' => 'string',
        'No. licencia' => 'string',
        'Vigencia licencia' => 'string',
        'Procedencia' => 'string',
        'Cliente' => 'string',
        'Proveeedor' => 'string',
        'TC No. Eco' => 'string',
        'TC No. Placas' => 'string',
        'Tarjeta circulación' => 'string',
        'TC marca' => 'string',
        'TC nivel combustible' => 'string',
        'Compañía Semi' => 'string',
        'Marca Semi' => 'string',
        'Año Semi' => 'integer',
        'No Eco Semi' => 'string',
        'No. Serie Semi' => 'string',
        'Tipo Semi' => 'string',
        'Temp Semi' => 'integer',
        'Nivel combustible Semi' => 'string',
        'Sellos' => 'string',
        'Compania Semi 2' => 'string',
        'Marca Semi 2' => 'string',
        'Año Semi 2' => 'string',
        'No. Eco Semi 2' => 'string',
        'No. Serie Semi 2' => 'string',
        'Tipo Semi 2' => 'string',
        'Temp Semi 2' => 'string',
        'Nivel Combustible Semi 2' => 'string',
        'Sellos 2' => 'string',
        'Comentarios' => 'string'
    );
    $writer = new XLSXWriter();
    $writer->writeSheetHeader('Inspecciones', $header);
    $array = array();

    foreach ($queryInspeccion->result() as $row) {
        $folio = $row->Folio;

        $array[0] = $folio;
        $array[1] = $row->TipoInspeccion;
        $array[2] = $row->FechaInspeccion;
        $array[3] = $row->HoraInspeccion;
        $array[4] = $row->TipoMovimiento;
        $array[5] = $row->nombreUsuarioInspCompleto;
        $array[6] = $row->nombreOpCompleto;
        $array[7] = $row->NumeroLicencia;
        $array[8] = $row->FechaVigencia;
        $array[9] = $row->Procedencia;
        $array[10] = $row->Cliente;
        $array[11] = $row->Proveedor;
        $array[12] = $row->NumEconomicoTracto;
        $array[13] = $row->NumPlacasTracto;
        $array[14] = $row->TarjetaCircTracto;
        $array[15] = $row->MarcaTracto;
        $array[16] = $row->nivelCombustTracto;
        $array[17] = $row->CompaniaSemirremolque;
        $array[18] = $row->MarcaSemirremolque;
        $array[19] = $row->AnioSemirremolque;
        $array[20] = $row->NumEconSemi;
        $array[21] = $row->NumSerieSemi;
        $array[22] = $row->TipoSemirremolque;
        $array[23] = $row->TemperaturaSemi;
        $array[24] = $row->NivelCombustSemi;
        $array[25] = $row->sellosSemi;
        $array[26] = $row->CompaniaSemirremolque2;
        $array[27] = $row->MarcaSemirremolque2;
        $array[28] = $row->AnioSemirremolque2;
        $array[29] = $row->NumEconSemi2;
        $array[30] = $row->NumSerieSemi2;
        $array[31] = $row->TipoSemirremolque2;
        $array[32] = $row->TemperaturaSemi2;
        $array[33] = $row->NivelCombustSemi2;
        $array[34] = $row->sellosSemi2;
        $array[35] = $row->ComentariosInspeccion;
        $writer->writeSheetRow('Inspecciones', $array);
    }

    $writer->writeToStdOut();
    exit();
}
