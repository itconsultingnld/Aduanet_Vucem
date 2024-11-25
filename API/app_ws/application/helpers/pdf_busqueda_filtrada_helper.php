<?php
$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];

function pdf_busqueda_filtrada($inspecciones)
{
    date_default_timezone_set('America/Matamoros');
    $fecha_actual_completa = date('Ymd');

    $CI = &get_instance();

    if (count($inspecciones) > 0) {
        $empresa_id = $inspecciones[0]['empresa_id'];
    } else {
        $empresa_id = 0;
    }

    $CI->load->library('F_pdf');
    $CI->F_pdf = new F_pdf('P', 'mm', 'letter');
    $CI->F_pdf->Open();
    $CI->F_pdf->SetAutoPageBreak(false);
    $CI->F_pdf->AddPage('L');

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

    $CI->F_pdf->SetXY(0, 13);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("RESULTADO DE BÚSQUEDA"), '0', 'C', false);
    $CI->F_pdf->SetXY(10, 25);
    $CI->F_pdf->SetFont('Arial', 'B', 9);
    $w = array(20, 15, 25, 35, 40, 50, 30, 20, 25);

    $current_y = $CI->F_pdf->GetY();
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[0], 12, 'Folio', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[1], 6, 'Fecha Hora', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[2], 6, 'Tipo movimiento', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[3], 12, 'Cliente', 'L,T,B', 'C');
    $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[4], 12, utf_decode('Tractocamión'), "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[5], 12, 'Semirremolque', "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[6], 12, utf_decode('Tipo inspección'), "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[7], 6, utf_decode('Tiempo inspección'), "L,T,B", 'C');
    $CI->F_pdf->SetXY($current_x + $w[7], $current_y);
    $current_x = $CI->F_pdf->GetX();
    $CI->F_pdf->MultiCell($w[8], 12, 'Sellos', "L,T,R,B", 'C');

    $CI->F_pdf->SetFont('Arial', '', 7);
    foreach ($inspecciones as $row) {
        $folio = $row['Folio'];
        $tipoInspeccion = utf_decode($row['TipoInspeccion']);
        $fecha_inspeccion = $row['FechaInspeccion'];
        $hora_inspeccion = substr($row['HoraInspeccion'], 0, 5);
        $tiempo_inspeccion = $row['tiempo_inspeccion'];
        $tipo_movimiento = utf_decode($row['TipoMovimiento']);
        $nombre_usuario_ins = strtoupper(utf_decode($row['nombreUsuarioInspCompleto']));
        $nombre_operador = strtoupper(utf_decode($row['nombreOpCompleto']));
        $numero_licencia = $row['NumeroLicencia'];
        $fecha_vigencia = $row['FechaVigencia'];
        $procedencia = utf_decode(strtoupper($row['Procedencia']));
        $cliente = strtoupper(utf_decode($row['Cliente']));
        $proveedor = strtoupper(utf_decode($row['Proveedor']));
        $num_econ_tracto = strtoupper($row['NumEconomicoTracto']);
        $num_placas_tracto = strtoupper($row['NumPlacasTracto']);
        $tarjeta_circ_tracto = strtoupper($row['TarjetaCircTracto']);
        $marca_tracto = strtoupper($row['MarcaTracto']);
        $nivel_combust_tracto = utf_decode($row['nivelCombustTracto']);

        $tipoInspeccion = str_replace(utf_decode("de Tractocamión "), "", $tipoInspeccion);
        $tipoInspeccion = str_replace("Doble ", "", $tipoInspeccion);

        $companiaSemi1 = $row['CompaniaSemirremolque'];
        $companiaSemi2 = $row['CompaniaSemirremolque2'];

        $num_serie_semi1 = $row['NumEconSemi'];
        $num_serie_semi2 = $row['NumEconSemi2'];

        $sellos1 = $row['sellosSemi'];
        $sellos2 = $row['sellosSemi2'];

        $cliente_len = strlen($cliente);
        if ($cliente_len < 21) {
            $cliente_multi = 2;
        } else {
            $cliente_multi = 1;
        }

        $companiaSemi1_len = strlen($companiaSemi1);
        $companiaSemi2_len = strlen($companiaSemi2);
        $numSerieSemi1 = strlen($num_serie_semi1);
        $numSerieSemi2 = strlen($num_serie_semi2);

        if ($companiaSemi1_len < 16 || $companiaSemi2_len < 16 || $numSerieSemi1 < 16 || $numSerieSemi2 < 16) {
            $companiaSemi_multi = 2;
        } else {
            $companiaSemi_multi = 1;
        }

        $sellos1_len = strlen($sellos1);
        $sellos2_len = strlen($sellos2);
        if ($sellos1_len < 6 || $sellos2_len < 7) {
            $sellos_multi = 2;
        } else {
            $sellos_multi = 1;
        }

        $current_y = $CI->F_pdf->GetY();
        $current_x = $CI->F_pdf->GetX();

        if ($current_y >= 180) {
            $CI->F_pdf->AddPage('L');
            $current_y = 10;
            $current_x = 10;
            $CI->F_pdf->SetFont('Arial', 'B', 9);
            $CI->F_pdf->MultiCell($w[0], 12, 'Folio', "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[1], 6, 'Fecha Hora', "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[2], 6, 'Tipo movimiento', "L,T.B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[3], 12, 'Cliente', 'L,T,B', 'C');
            $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[4], 12, utf_decode('Tractocamión'), "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[5], 12, 'Semirremolque', "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[6], 12, utf_decode('Tipo inspección'), "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[7], 6, utf_decode('Tiempo inspección'), "L,T,B", 'C');
            $CI->F_pdf->SetXY($current_x + $w[7], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[8], 12, 'Sellos', "L,T,R,B", 'C');
            $current_y = $CI->F_pdf->GetY();
            $current_x = $CI->F_pdf->GetX();
        }

        $CI->F_pdf->SetFont('Arial', '', 7);
        $CI->F_pdf->Line($current_x, $current_y + 10, $current_x + 260, $current_y + 10);
        $CI->F_pdf->MultiCell($w[0], 10, $folio, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[1], 5, $fecha_inspeccion . " " . $hora_inspeccion, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[2], 5, $tipo_movimiento, 0, 'J');
        $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[3], 5 * $cliente_multi, $cliente, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[4], 5, $num_econ_tracto . " - " . $proveedor, '0', 'J');
        $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
        $current_x = $CI->F_pdf->GetX();
        if (($companiaSemi2 == "" && $num_serie_semi2 == "") && ($companiaSemi1 == "" && $num_serie_semi1 == "")) {
            $CI->F_pdf->MultiCell($w[5], 10, "-", 'L,R', 'J');
        } else if ($companiaSemi2 == "" && $num_serie_semi2 == "") {
            $CI->F_pdf->MultiCell($w[5], 10, $num_serie_semi1 . " - " . $companiaSemi1, 'L,R', 'J');
        } else if ($companiaSemi1 == "" && $num_serie_semi1 == "") {
            $CI->F_pdf->MultiCell($w[5], 10, $num_serie_semi2 . " - " . $companiaSemi2, 'L,R', 'J');
        } else {
            $CI->F_pdf->MultiCell($w[5], 5, $num_serie_semi1 . " - " . $companiaSemi1 . "\n" . $num_serie_semi2 . " - " . $companiaSemi2, 'L,R', 'J');
        }
        $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[6], 10, $tipoInspeccion, 0, 'C');
        $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[7], 10, $tiempo_inspeccion, 'L', 'C');
        $CI->F_pdf->SetXY($current_x + $w[7], $current_y);
        $current_x = $CI->F_pdf->GetX();
        
        if ($sellos2 == "") {
            $CI->F_pdf->MultiCell($w[8], 10, $sellos1, 'L,R', 'C');
        } else {
            $CI->F_pdf->MultiCell($w[8], 5, $sellos1 . "\n" . $sellos2, 'L,R', 'C');
        }
        $current_x = $CI->F_pdf->GetX();
    }
    return $CI->F_pdf->Output("reporte_" . $fecha_actual_completa . ".pdf", 'I', false);
}
