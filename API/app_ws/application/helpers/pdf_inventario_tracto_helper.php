<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];



function pdf_inventarioTracto($get)
{
    date_default_timezone_set('America/Matamoros');
    $fecha_actual_completa = date('Y-m-d');

    $CI = &get_instance();
    $CI->load->database();

    $empresa_id = $get['empresa_id'];

    $queryInventario = $CI->db->query('select * from vw_tractos_patio where empresa_id = ' . $empresa_id . ' order by fechaInspeccion DESC, horaInspeccion DESC');

    $respuesta = $queryInventario->result();

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

    $CI->load->library('F_pdf');
    $CI->F_pdf = new F_pdf('P', 'mm', 'letter');
    $CI->F_pdf->Open();
    $CI->F_pdf->SetAutoPageBreak(false);
    $CI->F_pdf->AddPage('L');

    $logo_empresas = $GLOBALS['rutaLogos'] . $empresa_id . ".png";
    if (file_exists($logo_empresas)) {
        $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);
    }
    $CI->F_pdf->SetXY(0, 13);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("REPORTE DE TRACTOCAMIONES\nEN PATIO"), '0', 'C', false);
    $CI->F_pdf->SetXY(242, 5);
    $CI->F_pdf->Cell(0, 4, $fecha_actual_completa, '0', 'C', false);

    $CI->F_pdf->SetXY(30, 25);
    $CI->F_pdf->Cell(50, 7, utf_decode('Tractocamión'), 'L,T', 0, 'C');

    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $w = array(20, 30, 20, 50, 50, 40, 40);

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
    $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[3], 6, "Tipo\nmovimiento", 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[4], 12, utf_decode('Cliente'), 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[5], 12, utf_decode('Operador'), 1, 'C');
    $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[6], 12, utf_decode('Línea'), 1, 'C');



    $CI->F_pdf->SetFont('Arial', '', 9);

    foreach ($respuesta as $row) {

        $fecha_inspeccion = $row->fechaInspeccion;
        $hora_inspeccion = substr($row->horaInspeccion, 0, 5);
        $tipo_movimiento = utf_decode($row->Nombre);
        $cliente = strtoupper(utf_decode($row->empresaCliente));
        $placas = $row->numPlacas;
        $num_econ_tracto = $row->numEconTracto;
        $linea_transportista = utf_decode($row->empresaProveedor);
        $operador = utf_decode($row->nombreOperador);

        $operador_len = strlen($operador);
        if ($operador_len < 18) {
            $operador_multi = 2;
        } else {
            $operador_multi = 1;
        }

        $current_y = $CI->F_pdf->GetY();
        $current_x = $CI->F_pdf->GetX();

        if ($current_y >= 180) {

            $CI->F_pdf->AddPage('L');
            $CI->F_pdf->SetFont('Arial', 'B', 12);
            $CI->F_pdf->SetXY(30, 10);
            $CI->F_pdf->Cell(50, 7, utf_decode('Tractocamión'), 'L,T', 0, 'C');

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
            $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[3], 6, "Tipo\nmovimiento", 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[4], 12, utf_decode('Cliente'), 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[5], 12, utf_decode('Operador'), 1, 'C');
            $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[6], 12, utf_decode('Línea'), 1, 'C');
            $current_y = $CI->F_pdf->GetY();
            $current_x = $CI->F_pdf->GetX();
        }
        $CI->F_pdf->SetFont('Arial', '', 9);
        $CI->F_pdf->Line($current_x, $current_y + 10, $current_x + 250, $current_y + 10);
        $CI->F_pdf->MultiCell($w[0], 10, $fecha_inspeccion, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[1], 10, $num_econ_tracto, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[2], 10, $placas, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[3], 10, $tipo_movimiento, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[4], 10, $cliente, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[5], 5 * $operador_multi, $operador, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[6], 10, $linea_transportista, 'L,R', 'L');
        $current_x = $CI->F_pdf->GetX();
        $current_y = $CI->F_pdf->GetY();
    }

    return $CI->F_pdf->Output("reporte_" . $fecha_actual_completa . ".pdf", 'I', false);
}
