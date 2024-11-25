<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];



function pdf_inventario($get)
{
    date_default_timezone_set('America/Matamoros');
    $fecha_actual_completa = date('Y-m-d');

    $CI = &get_instance();
    $CI->load->database();

    $empresa_id = $get['empresa_id'];

    $queryInventario = $CI->db->query('select * from vw_cajas_patio where empresa_id = ' . $empresa_id . ' order by fechaInspeccion DESC, horaInspeccion DESC');

    $respuesta = $queryInventario->result();

    $cajas = array();
    for ($i = 0; $i < count($respuesta); $i++) {
        $semiID = $respuesta[$i]->semirremolqueID;
        if (in_array($semiID, $cajas)) {
            array_splice($respuesta, $i, 1);
            $i--;
        } else {
            array_push($cajas, $semiID);
        }
    }

    $CI->load->library('F_pdf');
    $CI->F_pdf = new F_pdf('P', 'mm', 'letter');
    $CI->F_pdf->Open();
    $CI->F_pdf->SetAutoPageBreak(false);
    $CI->F_pdf->AddPage('L');

    $logo_empresa = $GLOBALS['rutaLogos'] . $empresa_id . ".png";
    if (file_exists($logo_empresa)) {
        $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);
    }
    $CI->F_pdf->SetXY(0, 13);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("REPORTE DE CAJAS EN PATIO"), '0', 'C', false);
    $CI->F_pdf->SetXY(242, 5);
    $CI->F_pdf->Cell(0, 4, $fecha_actual_completa, '0', 'C', false);

    $CI->F_pdf->SetXY(30, 25);
    $CI->F_pdf->Cell(150, 7, 'Semirremolque', 'L,T', 0, 'C');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $w = array(20, 20, 20, 40, 40, 30, 45, 35);

    $CI->F_pdf->SetXY(10, 25);

    $current_y = $CI->F_pdf->GetY();
    $current_x = $CI->F_pdf->GetX();

    $CI->F_pdf->MultiCell($w[0], 12, 'Fecha', 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[0], $current_y + 6);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[1], 6, 'No Eco', 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[1], $current_y + 6);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[2], 6, 'Placas', 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[2], $current_y + 6);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[3], 6, utf_decode('Línea'), 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[3], $current_y + 6);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[4], 6, utf_decode('Sellos'), 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[4], $current_y + 6);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[5], 6, utf_decode('Tipo'), 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[6], 6, "Tipo\nmovimiento", 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[7], 12, utf_decode('Cliente'), 1, 'C');


    $CI->F_pdf->SetFont('Arial', '', 8);

    foreach ($respuesta as $row) {

        $folio = $row->folio;
        $fecha_inspeccion = $row->fechaInspeccion;
        $hora_inspeccion = substr($row->horaInspeccion, 0, 5);
        $tipo_movimiento = utf_decode($row->Nombre);
        $cliente = strtoupper(utf_decode($row->empresaCliente));
        $companiaSemi = utf_decode($row->nombreCompania);
        $sellos = $row->sellosSemi;
        $placas = $row->SR_numPlacas;
        $num_econ_semi = $row->numEconSemi;
        $tipo_semi = $row->tipoSemirremolque;

        $current_y = $CI->F_pdf->GetY();
        $current_x = $CI->F_pdf->GetX();

        if ($current_y >= 180) {

            $CI->F_pdf->AddPage('L');
            $CI->F_pdf->SetFont('Arial', 'B', 12);
            $CI->F_pdf->SetXY(30, 10);
            $CI->F_pdf->Cell(150, 7, 'Semirremolque', 'L,T', 0, 'C');

            $current_y = 10;
            $current_x = 10;
            $CI->F_pdf->SetXY($current_x, $current_y);
            $CI->F_pdf->MultiCell($w[0], 12, 'Fecha', 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[0], $current_y + 6);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[1], 6, 'No Eco', 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[1], $current_y + 6);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[2], 6, 'Placas', 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[2], $current_y + 6);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[3], 6, utf_decode('Línea'), 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[3], $current_y + 6);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[4], 6, utf_decode('Sellos'), 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[4], $current_y + 6);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[5], 6, utf_decode('Tipo'), 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[6], 6, "Tipo\nmovimiento", 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[7], 12, utf_decode('Cliente'), 1, 'C');
            $current_y = $CI->F_pdf->GetY();
            $current_x = $CI->F_pdf->GetX();
        }

        $companiaSemi_len = strlen($companiaSemi);
        if ($companiaSemi_len < 21) {
            $companiaSemi_multi = 2;
        } else {
            $companiaSemi_multi = 1;
        }

        $cliente_len = strlen($cliente);
        if ($cliente_len < 17) {
            $cliente_multi = 2;
        } else {
            $cliente_multi = 1;
        }
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Line($current_x, $current_y + 10, $current_x + 250, $current_y + 10);
        $CI->F_pdf->MultiCell($w[0], 10, $fecha_inspeccion, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[1], 10, $num_econ_semi, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[2], 10, $placas, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[3], 5 * $companiaSemi_multi, $companiaSemi, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[4], 10, $sellos, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[5], 10, $tipo_semi, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[6], 10, $tipo_movimiento, 0, 'J');
        $CI->F_pdf->Line($current_x + $w[6], $current_y, $current_x + $w[6], $current_y + 10);
        $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[7], 5 * $cliente_multi, $cliente, 0, 'J');
        $CI->F_pdf->Line($current_x + $w[7], $current_y, $current_x + $w[7], $current_y + 10);
        $CI->F_pdf->SetXY($current_x + 1, $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell(1, 10, '', '0', 'J');
    }

    return $CI->F_pdf->Output("reporte_" . $fecha_actual_completa . ".pdf", 'I', false);
}
