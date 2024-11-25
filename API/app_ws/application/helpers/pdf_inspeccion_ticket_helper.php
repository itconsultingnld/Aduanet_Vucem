<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];




function pdf_formato_inspeccion_ticket($post)
{
    $CI = &get_instance();
    $CI->load->database();

    $inspeccionID = $post['inspeccionID'];
    $queryInspeccion = $CI->db->get_where('vw_inspecciones', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccion->result() as $row) {
        $folio = $row->Folio;
        $tipoInspeccion = utf_decode($row->TipoInspeccion);
        $fecha_inspeccion = $row->FechaInspeccion;
        $hora_inspeccion = substr($row->HoraInspeccion, 0, 5);
        $tipo_movimiento = utf_decode($row->TipoMovimiento);
        $nombre_usuario_ins = strtoupper(utf_decode($row->nombreUsuarioInspCompleto));
        $nombre_operador = strtoupper(utf_decode($row->nombreOpCompleto));
        $procedencia = utf_decode(strtoupper($row->Procedencia));
        $cliente = strtoupper(utf_decode($row->Cliente));
        $proveedor = strtoupper($row->Proveedor);
        $num_econ_tracto = strtoupper($row->NumEconomicoTracto);
        $num_placas_tracto = strtoupper($row->NumPlacasTracto);
        $compania_semirremolque = strtoupper(utf_decode($row->CompaniaSemirremolque));
        $marca_semirremolque = strtoupper($row->MarcaSemirremolque);
        $num_econ_semi = strtoupper($row->NumEconSemi);
        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));
        $sellosSemi = strtoupper(utf_decode($row->sellosSemi));
        $cajon = strtoupper(utf_decode($row->cajon));
        $estatus_Semi1 = strtoupper(utf_decode($row->estatusSemi));
        $sr_placa_1 = $row->sr_placa_1;
        $sr_placa_edo_1 = $row->sr_placa_edo_1;
    }
    $queryInspeccionDetalles = $CI->db->get_where('inspecciones_detalles', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccionDetalles->result() as $row) {
        $comentarios_tracto = $row->comentariosTracto;
        $comentInsp = ($row->comentInsp);
    }

    $CI->load->library('F_pdf');
    $CI->F_pdf = new F_pdf($orientation = 'P', $unit = 'mm', array(80, 120));
    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetFont('Arial', 'B', 6.5);   
    $textypos = 5;
    $CI->F_pdf->setY(2);
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(50, $textypos, str_replace(utf_decode(" de Tractocamión"), "", $tipoInspeccion), 0, 0, 'C');
    $CI->F_pdf->SetFont('Arial', '', 5.5);   


    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, '----------------------- DATOS GENERALES -----------------------');
    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(50, $textypos, 'FECHA: ' . $fecha_inspeccion . "       " . 'HORA: ' . $hora_inspeccion, 0, 0, 'C');

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'GUARDIA: ' . $nombre_usuario_ins);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'OPERADOR: ' . $nombre_operador);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'CLIENTE: ' . $cliente);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('TIPO DE OPERACIÓN: ' . $tipo_movimiento));

    if (strpos($tipoInspeccion, "Entrada") !== false) {
        $textypos += 7;
        $CI->F_pdf->setX(2);
        $CI->F_pdf->Cell(5, $textypos, 'ORIGEN: ' . $procedencia);
    } else {
        $textypos += 7;
        $CI->F_pdf->setX(2);
        $CI->F_pdf->Cell(5, $textypos, 'DESTINO: ' . $procedencia);
    }

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('-------------------------- TRACTOCAMIÓN --------------------------'));

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('LÍNEA: ' . $proveedor));

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'PLACAS: ' . $num_placas_tracto);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('N° ECONÓMICO: ') . $num_econ_tracto);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, '------------------------- SEMIRREMOLQUE -------------------------');

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('LÍNEA: ' . $compania_semirremolque));

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'PLACAS: ' . $sr_placa_1);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('N° ECONÓMICO: ') . $num_econ_semi);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'SELLOS: ' . $sellosSemi);




    $CI->F_pdf->output();
}
