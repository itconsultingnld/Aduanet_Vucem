<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];

function pdf_trazabilidad($trazabilidadEncontrada, $empresa_id)
{
    date_default_timezone_set('America/Matamoros');
    $fecha_actual_completa = date('Ymd');

    $CI = &get_instance();
    $CI->load->database();

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
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("RESULTADO DE BÚSQUEDA\nTRAZABILIDAD"), '0', 'C', false);
    $CI->F_pdf->SetXY(10, 25);
    $CI->F_pdf->SetFont('Arial', 'B', 9);
    $w = array(22, 35, 15, 24, 35, 28, 19, 33);

    $current_y = $CI->F_pdf->GetY();
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[0], 6, 'Tipo movimiento', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[1], 12, 'Cliente', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[2], 6, 'Fecha entrada', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[5], 6, utf_decode('Tractocamión entrada'), 'L,T,B', 'C');
    $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[4], 12, utf_decode('Operador entrada'), 'L,T,B', 'C');
    $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[5], 12, utf_decode('Semirremolque'), "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[6], 6, 'Placas' . "\n" . ' semi', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[2], 6, utf_decode('Fecha salida'), "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[5], 6, utf_decode("Tractocamión salida"), "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[7], 12, utf_decode('Operador salida'), "L,T,R,B", 'C');

    $CI->F_pdf->SetFont('Arial', '', 7);

    foreach ($trazabilidadEncontrada as $row) {

        $TipoMovimiento = strtoupper(utf_decode($row['TipoMovimiento']));
        $Cliente = strtoupper(utf_decode($row['Cliente']));
        $FechaEntrada = $row['FechaEntrada'];
        $HoraEntrada = substr($row['HoraEntrada'], 0, 5);
        $NumEconTractoEntrada = utf_decode($row['NumEconTractoEntrada']);
        $ProveedorEntrada = strtoupper(utf_decode($row['ProveedorEntrada']));
        $numEconSemi = $row['numEconSemi'];
        $linea_semi = strtoupper(utf_decode($row['linea_semi']));
        $placasSemi = utf_decode(strtoupper($row['placasSemi']));
        $FechaSalida = $row['FechaSalida'];
        $HoraSalida = substr($row['HoraSalida'], 0, 5);
        $NumEconTractoSalida = utf_decode(strtoupper($row['NumEconTractoSalida']));
        $ProveedorSalida = utf_decode(strtoupper($row['ProveedorSalida']));
        $OperadorEntrada = utf_decode(strtoupper($row['OperadorEntrada']));
        $OperadorSalida = utf_decode(strtoupper($row['OperadorSalida']));

        $cliente_len = strlen($Cliente);
        if ($cliente_len < 18) {
            $cliente_multi = 2;
        } else {
            $cliente_multi = 1;
        }

        $linea_semi_len = strlen($linea_semi);
        if ($linea_semi_len < 18) {
            $linea_semi_multi = false;
        } else {
            $linea_semi_multi = true;
        }

        $OperadorEntrada_len = strlen($OperadorEntrada);
        if ($OperadorEntrada_len < 20) {
            $OperadorEntrada_multi = 2;
        } else {
            $OperadorEntrada_multi = 1;
        }

        $OperadorSalida_len = strlen($OperadorSalida);
        if ($OperadorSalida_len < 20) {
            $OperadorSalida_multi = 2;
        } else {
            $OperadorSalida_multi = 1;
        }



        $ProveedorEntrada_len = strlen($ProveedorEntrada);
        if ($ProveedorEntrada_len < 15) {
            $ProveedorEntrada_multi = false;
        } else {
            $ProveedorEntrada_multi = true;
        }


        $ProveedorSalida_len = strlen($ProveedorSalida);
        if ($ProveedorSalida_len < 15) {
            $ProveedorSalida_multi = false;
        } else {
            $ProveedorSalida_multi = true;
        }


        $current_y = $CI->F_pdf->GetY();
        $current_x = $CI->F_pdf->GetX();

        if ($current_y >= 180) {

            $CI->F_pdf->AddPage('L');
            $current_y = 10;
            $current_x = 10;
            $CI->F_pdf->SetFont('Arial', 'B', 9);


            $CI->F_pdf->MultiCell($w[0], 6, 'Tipo movimiento', "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[1], 12, 'Cliente', "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[2], 6, 'Fecha entrada', "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[5], 6, utf_decode('Tractocamión entrada'), 'L,T,B', 'C');
            $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[4], 12, utf_decode('Operador entrada'), 'L,T,B', 'C');
            $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[5], 12, utf_decode('Semirremolque'), "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[6], 6, 'Placas' . "\n" . ' semi', "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[2], 6, utf_decode('Fecha salida'), "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[5], 6, utf_decode("Tractocamión salida"), "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[7], 12, utf_decode('Operador salida'), "L,T,R,B", 'C');



            $current_y = $CI->F_pdf->GetY();
            $current_x = $CI->F_pdf->GetX();
        }

        $CI->F_pdf->SetFont('Arial', '', 7);
        $CI->F_pdf->Line($current_x, $current_y + 10, $current_x + 258, $current_y + 10);

        $CI->F_pdf->MultiCell($w[0], 10, $TipoMovimiento, 'L,R', 'C');
        $CI->F_pdf->SetXY($current_x + $w[0], $current_y);

        $current_x = $CI->F_pdf->GetX();

        $CI->F_pdf->MultiCell($w[1], 5 * $cliente_multi, $Cliente, '0', 'C');
        $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
        $current_x = $CI->F_pdf->GetX();

        $CI->F_pdf->MultiCell($w[2], 5, $FechaEntrada . "\n" . $HoraEntrada, 'L,R', 'C');
        $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
        $current_x = $CI->F_pdf->GetX();



        if ($ProveedorEntrada_multi) {
            $CI->F_pdf->SetFont('Arial', '', 6);
            $CI->F_pdf->MultiCell($w[5], 3, $NumEconTractoEntrada . "\n" . $ProveedorEntrada, '0', 'C');
            $CI->F_pdf->SetFont('Arial', '', 7);
        } else {
            $CI->F_pdf->MultiCell($w[5], 5, $NumEconTractoEntrada . "\n" . $ProveedorEntrada, '0', 'C');
        }
        $CI->F_pdf->Line($current_x + $w[5], $current_y, $current_x + $w[5], $current_y + 10);

        $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
        $current_x = $CI->F_pdf->GetX();


        $CI->F_pdf->MultiCell($w[4], 5 * $OperadorEntrada_multi, $OperadorEntrada, '0', 'C');
        $CI->F_pdf->Line($current_x + $w[4], $current_y, $current_x + $w[4], $current_y + 10);
        $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
        $current_x = $CI->F_pdf->GetX();

        if ($linea_semi_multi) {
            $CI->F_pdf->SetFont('Arial', '', 6);
            $CI->F_pdf->MultiCell($w[5], 3, $numEconSemi . "\n" . $linea_semi, '0', 'C');
            $CI->F_pdf->SetFont('Arial', '', 7);
        } else {
            $CI->F_pdf->MultiCell($w[5], 5, $numEconSemi . "\n" . $linea_semi, '0', 'C');
        }

        $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
        $current_x = $CI->F_pdf->GetX();

        $CI->F_pdf->MultiCell($w[6], 10, $placasSemi, 'L', 'C');
        $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
        $current_x = $CI->F_pdf->GetX();

        $CI->F_pdf->MultiCell($w[2], 5, $FechaSalida . "\n" . $HoraSalida, 'L,R', 'C');
        $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
        $current_x = $CI->F_pdf->GetX();



        if ($ProveedorSalida_multi) {
            $CI->F_pdf->SetFont('Arial', '', 6);
            $CI->F_pdf->MultiCell($w[5], 3, $NumEconTractoSalida . "\n" . $ProveedorSalida, '0', 'C');
            $CI->F_pdf->SetFont('Arial', '', 7);
        } else {
            $CI->F_pdf->MultiCell($w[5], 5, $NumEconTractoSalida . "\n" . $ProveedorSalida, '0', 'C');
        }



        $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
        $current_x = $CI->F_pdf->GetX();



        if ($OperadorSalida_len > 35) {
            $CI->F_pdf->SetFont('Arial', '', 6);
            $CI->F_pdf->MultiCell($w[7], 3, $OperadorSalida, '0', 'C');
            $CI->F_pdf->SetXY($current_x + 38, $current_y);

            $CI->F_pdf->Line($current_x, $current_y, $current_x, $current_y + 10);
            $CI->F_pdf->Line($current_x + 33, $current_y, $current_x + 33, $current_y + 10);
        } else {
            $CI->F_pdf->MultiCell($w[7], 5 * $OperadorSalida_multi, $OperadorSalida, 'L,R', 'C');
            $CI->F_pdf->SetXY($current_x + 38, $current_y);
        }








        $current_x = $CI->F_pdf->GetX();

        $current_x = $CI->F_pdf->GetX();

        $CI->F_pdf->SetY($current_y + 10);
    }

    return $CI->F_pdf->Output("reporte_trazabilidad" . $fecha_actual_completa . ".pdf", 'I', false);
}
