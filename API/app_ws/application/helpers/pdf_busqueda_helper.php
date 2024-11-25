<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];

function pdf_busqueda($post)
{
    date_default_timezone_set('America/Matamoros');
    $fecha_actual_completa = date('Ymd');

    $CI = &get_instance();
    $CI->load->database();

    $folios = $post['Folios'];
    $es_transportista = $post['es_transportista'];
    if ($folios == '') {
        $folios = "0";
    }
    $queryInspeccion = $CI->db->query('select * from vw_inspecciones where inspeccionID in (' . $folios . ') order by FechaInspeccion desc, HoraInspeccion desc');

    if ($queryInspeccion && $queryInspeccion->num_rows() > 0) {
        $empresa_id = $queryInspeccion->row()->empresa_id;
    } else {
        $empresa_id = 0;
    }

    $CI->load->library('F_pdf');
    $CI->F_pdf = new F_pdf('P', 'mm', 'letter');
    $CI->F_pdf->Open();
    $CI->F_pdf->SetAutoPageBreak(false);
    $CI->F_pdf->AddPage('L');

    $logo_empresa = $GLOBALS['rutaLogos'] . $empresa_id . ".png";
    if(file_exists($logo_empresa)){
        $CI->F_pdf->Image($logo_empresa, 16, 8, -500);
    }

    $CI->F_pdf->SetXY(0, 13);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("RESULTADO DE BÚSQUEDA\nCONTROL DE ACCESOS"), '0', 'C', false);
    $CI->F_pdf->SetXY(10, 25);
    $CI->F_pdf->SetFont('Arial', 'B', 9);
    $w = array(20, 15, 25, 35, 35, 40, 36, 19, 35);

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
    if ($queryInspeccion && $queryInspeccion->num_rows() > 0) {
        foreach ($queryInspeccion->result() as $row) {

            $folio = $row->Folio;
            $tipoInspeccion = utf_decode($row->TipoInspeccion);
            $fecha_inspeccion = $row->FechaInspeccion;
            $hora_inspeccion = substr($row->HoraInspeccion, 0, 5);
            $tiempo_inspeccion = $row->tiempo_inspeccion;
            $tipo_movimiento = utf_decode($row->TipoMovimiento);
            $cliente = strtoupper(utf_decode($row->Cliente));
            $proveedor = strtoupper(utf_decode($row->Proveedor));
            $num_econ_tracto = strtoupper($row->NumEconomicoTracto);

            $tipoInspeccion = str_replace(utf_decode("de Tractocamión "), "", $tipoInspeccion);
            $tipoInspeccion = str_replace("Doble ", "", $tipoInspeccion);

            $companiaSemi1 = $row->CompaniaSemirremolque;
            $companiaSemi2 = $row->CompaniaSemirremolque2;

            $num_serie_semi1 = $row->NumEconSemi;
            $num_serie_semi2 = $row->NumEconSemi2;

            $sellos1 = $row->sellosSemi;
            $sellos2 = $row->sellosSemi2;

            $cliente_len = strlen($cliente);
            if ($cliente_len < 21) {
                $cliente_multi = 2;
            } else {
                $cliente_multi = 1;
            }

            $tracto_divi = 0;
            $proveedor_len = strlen($proveedor);
            $numEconTracto_len = strlen($num_econ_tracto);

            if($proveedor_len + $numEconTracto_len < 18){
                $tracto_divi = 1;
            }else{
                $tracto_divi = 2;
            }

            $companiaSemi1_len = strlen($companiaSemi1);
            $companiaSemi2_len = strlen($companiaSemi2);
            $numSerieSemi1 = strlen($num_serie_semi1);
            $numSerieSemi2 = strlen($num_serie_semi2);

            
            $companiaSemi_multi = 0;
            if (($companiaSemi2 == "" && $num_serie_semi2 == "") && ($companiaSemi1 == "" && $num_serie_semi1 == "")) {
                $companiaSemi_multi = 1;
            } else if ($companiaSemi2 == "" && $num_serie_semi2 == "") {
                if ($companiaSemi1_len + $numSerieSemi1 < 16) {
                    $companiaSemi_multi = 1;
                } else {
                    $companiaSemi_multi = 2;
                }
            } else if ($companiaSemi1 == "" && $num_serie_semi1 == "") {
                if ($companiaSemi2_len + $numSerieSemi2 < 16) {
                    $companiaSemi_multi = 1;
                } else {
                    $companiaSemi_multi = 2;
                }
            } else {
                if ($companiaSemi1_len + $numSerieSemi1 < 16) {
                    $companiaSemi_multi += 1;
                } else {
                    $companiaSemi_multi += 2;
                }
                if ($companiaSemi2_len + $numSerieSemi2 < 16) {
                    $companiaSemi_multi += 1;
                } else {
                    $companiaSemi_multi += 2;
                }
            }


            $sellos_multi = 0;
            if ($sellos1 != "") {
                $sellos1_len = strlen($sellos1);
                if ($sellos1_len < 27) {
                    $sellos_multi += 1;
                } else {
                    $sellos_multi += 2;
                }
            }
            if ($sellos2 != "") {
                $sellos2_len = strlen($sellos2);
                if ($sellos2_len < 27) {
                    $sellos_multi += 1;
                } else {
                    $sellos_multi += 2;
                }
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
                $CI->F_pdf->MultiCell($w[7], 6, utf_decode('Tiempo inspección'), "L,T,B", 'C');
                $CI->F_pdf->SetXY($current_x + $w[7], $current_y);
                $current_x = $CI->F_pdf->GetX();
                $CI->F_pdf->MultiCell($w[8], 12, 'Sellos', "L,T,R,B", 'C');
                $current_y = $CI->F_pdf->GetY();
                $current_x = $CI->F_pdf->GetX();
            }

            $CI->F_pdf->SetFont('Arial', '', 7);
            $CI->F_pdf->Line($current_x, $current_y + 15, $current_x + 260, $current_y + 15);
            $CI->F_pdf->MultiCell($w[0], 15, $folio, 'L,R', 'J');
            $CI->F_pdf->SetXY($current_x + $w[0], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[1], 7.5, $fecha_inspeccion . " " . $hora_inspeccion, 'L,R', 'J');
            $CI->F_pdf->SetXY($current_x + $w[1], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[2], 7.5, $tipo_movimiento, 0, 'J');
            $CI->F_pdf->Line($current_x + $w[2], $current_y, $current_x + $w[2], $current_y + 15);
            $CI->F_pdf->SetXY($current_x + $w[2], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[3], 7.5 * $cliente_multi, $cliente, 0, 'L');
            $CI->F_pdf->Line($current_x + $w[3], $current_y, $current_x + $w[3], $current_y + 15);
            $CI->F_pdf->SetXY($current_x + $w[3], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[4], 15 / $tracto_divi, $num_econ_tracto . " - " . $proveedor, '0', 'L');
            $CI->F_pdf->SetXY($current_x + $w[4], $current_y);
            $current_x = $CI->F_pdf->GetX();
            if (($companiaSemi2 == "" && $num_serie_semi2 == "") && ($companiaSemi1 == "" && $num_serie_semi1 == "")) {
                $CI->F_pdf->MultiCell($w[5], 15, "-", 'L,R', 'L');
            } else if ($companiaSemi2 == "" && $num_serie_semi2 == "") {
                $CI->F_pdf->MultiCell($w[5], 15 / $companiaSemi_multi, $num_serie_semi1 . " - " . $companiaSemi1, 'L,R', 'L');
            } else if ($companiaSemi1 == "" && $num_serie_semi1 == "") {
                $CI->F_pdf->MultiCell($w[5], 15 / $companiaSemi_multi, $num_serie_semi2 . " - " . $companiaSemi2, 'L,R', 'L');
            } else {
                $CI->F_pdf->MultiCell($w[5], 15 / $companiaSemi_multi, $num_serie_semi1 . " - " . $companiaSemi1 . "\n" . $num_serie_semi2 . " - " . $companiaSemi2, 'L,R', 'L');
            }
            $CI->F_pdf->SetXY($current_x + $w[5], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[6], 15, $tipoInspeccion, "R", 'L');
            $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
            $current_x = $CI->F_pdf->GetX();
            $CI->F_pdf->MultiCell($w[7], 15, $tiempo_inspeccion, 0, 'L');
            $CI->F_pdf->SetXY($current_x + $w[7], $current_y);
            $current_x = $CI->F_pdf->GetX();
            if ($sellos1 == "" && $sellos2 == "") {
                $CI->F_pdf->MultiCell($w[8], 15, "-", 'L,R', 'L');
            } else if ($sellos2 == "") {
                $CI->F_pdf->MultiCell($w[8], 15 / $sellos_multi, $sellos1, 'L,R', 'L');
            } else if ($sellos1 == "") {
                $CI->F_pdf->MultiCell($w[8], 15 / $sellos_multi, $sellos2, 'L,R', 'L');
            } else {
                $CI->F_pdf->MultiCell($w[8], 15 / $sellos_multi, $sellos1 . "\n" . $sellos2, 'L,R', 'L');
            }
            $current_x = $CI->F_pdf->GetX();
        }
    }

    return $CI->F_pdf->Output("reporte_" . $fecha_actual_completa . ".pdf", 'I', false);
}
