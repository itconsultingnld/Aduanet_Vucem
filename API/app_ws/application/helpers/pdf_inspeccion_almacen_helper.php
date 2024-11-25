<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];



function siglasToCompleto($a)
{
    switch ($a) {
        case 'SC':
            return "SI CUMPLE";
        case 'NC':
            return "NO CUMPLE";
        case 'NA':
            return "NO APLICA";
        case "0":
            return "";
        default:
            return $a;
    }
}

function pdf_formato_inspeccionAlmacen($post)
{
    $CI = &get_instance();
    $CI->load->database();

    $inspeccionID = $post['inspeccionID'];
    $es_transportista = $post['es_transportista'];
    $queryInspeccion = $CI->db->get_where('vw_inspecciones', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccion->result() as $row) {
        $folio = $row->Folio;
        $fecha_inspeccion = $row->FechaInspeccion;
        $hora_inspeccion = substr($row->HoraInspeccion, 0, 5);
        $tiempo_inspeccion = $row->tiempo_inspeccion;
        $tipo_movimiento = utf_decode($row->TipoMovimiento);
        $nombre_usuario_ins = strtoupper(utf_decode($row->nombreUsuarioInspCompleto));
        $procedencia = utf_decode(strtoupper($row->Procedencia));
        $cliente = strtoupper(utf_decode($row->Cliente));
        $proveedor = strtoupper(utf_decode($row->Proveedor));
        $cajon = strtoupper(utf_decode($row->cajon));
        $sellosSemi = strtoupper(utf_decode($row->sellosSemi));

        $num_gps = $row->num_gps;
        $num_gafete = $row->numControlOp;
        $autoriza = $row->autoriza_por_monitoreo;

        $descripcion_producto = $row->descripcion_producto;
        $peso = $row->peso;
        $piezas = $row->piezas;
        $numero_tarimas = $row->numero_tarimas;
        $factura_orden = $row->factura_orden;

        $empresa_id = $row->empresa_id;
        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));
    }
    $queryInspeccionDetalles = $CI->db->get_where('inspecciones_detalles', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccionDetalles->result() as $row) {
        $SR_puertasInt = siglasToCompleto($row->SR_puertasInt);
        $SR_bisagras = siglasToCompleto($row->SR_bisagras);
        $SR_mecanCierre = siglasToCompleto($row->SR_mecanCierre);
        $SR_paredIntLateral = siglasToCompleto($row->SR_paredIntLateral);
        $SR_paredIntFrontal = siglasToCompleto($row->SR_paredIntFrontal);
        $SR_pisoInt = siglasToCompleto($row->SR_pisoInt);
        $SR_techoInt = siglasToCompleto($row->SR_techoInt);
        $SR_olores = siglasToCompleto($row->SR_olores);
        $SR_plagas = siglasToCompleto($row->SR_plagas);
        $SR_excesoTierraLodo = siglasToCompleto($row->SR_excesoTierraLodo);
        $SR_basura = siglasToCompleto($row->SR_basura);
        $SR_medLargo = $row->SR_medLargo;
        $SR_medAncho = $row->SR_medAncho;
        $SR_medAlto = ($row->SR_medAlto);
        $SR_puertaInt = siglasToCompleto($row->SR_puertaInt);
        $SR_selloVVTT = siglasToCompleto($row->SR_selloVVTT);
        $SR_numPlacas = ($row->SR_numPlacas);
        $SR_estadoPlaca = utf_decode($row->SR_estadoPlaca);
        
    }

    $queryInspeccionImagenes = $CI->db->get_where('imagenes_inspecciones', array('folio' => $folio));
    $imagenes = $queryInspeccionImagenes->result();

    $rutaServerFolio = $GLOBALS['rutaServer'] . $folio . $GLOBALS['rutaDivisor'];

    $CI->load->library('F_pdf');
    $CI->F_pdf = new F_pdf('P', 'mm', 'letter');
    $CI->F_pdf->Open();
    $CI->F_pdf->SetAutoPageBreak(false);
    $CI->F_pdf->AddPage();

    $logo = $GLOBALS['rutaLogos'] . $empresa_id . ".png";
    if (file_exists($logo)) {
        $CI->F_pdf->Image($logo, 16, 8, -500);
    }

    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("INSPECCIÓN EN ALMACÉN"), '0', 'C', false);

    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(90, 8, "FOLIO: ", 0, 0, 'R');
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->SetTextColor(255, 0, 0);
    $CI->F_pdf->Cell(70, 8, $folio, 0, 1, '');

    $CI->F_pdf->SetXY(13, 21);
    $CI->F_pdf->SetDrawColor(192, 192, 192);
    $CI->F_pdf->SetTextColor(0, 0, 0);

    $CI->F_pdf->SetXY(15, 28);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    if ($cajon == "") {
        $CI->F_pdf->Cell(20, 8, utf_decode("FECHA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $fecha_inspeccion, 'T,B', 1, '');
        $CI->F_pdf->SetXY(60, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("HORA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $hora_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(97, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("TIEMPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tiempo_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(135, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    } else {
        $CI->F_pdf->Cell(16.5, 8, utf_decode("FECHA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $fecha_inspeccion, 'T,B', 0, 'L');
        $CI->F_pdf->SetXY(51, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("HORA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $hora_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(77, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(18, 8, utf_decode("TIEMPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tiempo_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(112, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(16.5, 8, utf_decode("CAJÓN: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $cajon, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(136, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    }

    $CI->F_pdf->SetXY(15, 36);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(53, 8, utf_decode(" Nombre de quien inspecciona: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetXY(68, 36);
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_usuario_ins, 'B,R', 1, '');

    $CI->F_pdf->SetXY(15, 44);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Destino: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $procedencia, 'B,R', 1, '');

    $CI->F_pdf->SetXY(15, 52);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Cliente: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $cliente, 'B,R', 1, '');

    $CI->F_pdf->SetXY(15, 60);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Descripción del producto: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $descripcion_producto, 'B,R', 1, '');

    $CI->F_pdf->SetXY(15, 68);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Peso: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $peso, 'B,R', 1, '');

    $CI->F_pdf->SetXY(15, 76);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Piezas: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $piezas, 'B,R', 1, '');

    $CI->F_pdf->SetXY(15, 84);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("No. de tarimas: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $numero_tarimas, 'B,R', 1, '');

    $CI->F_pdf->SetXY(15, 92);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Factura/Orden de cargo: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $factura_orden, 'B,R', 1, '');

    $x = $CI->F_pdf->GetX(); /* 10 */
    $y = $CI->F_pdf->GetY(); /* 100 */

    $aumento_y = 0;
    $aumento_y_tabla = 0;
    
    if ($es_transportista == 3) {
        $aumento_y_tabla = 11;
        $aumento_y = 16;
        
        $CI->F_pdf->SetXY(15, 100);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(30, 8, utf_decode("No. GPS: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $num_gps, 'T,B,R', 2, '');

        $CI->F_pdf->SetXY(15, 108);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(30, 8, utf_decode("Autoriza por monitoreo: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $autoriza, 'T,B,R', 2, '');
    }

    $CI->F_pdf->SetXY(10, 100+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE"), 0, 1, 'C');

    
    $CI->F_pdf->SetXY(15, 114+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Puertas parte interior:"), 'L,,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_puertaInt, 'B,R,T', 0, '');

    $CI->F_pdf->SetXY(100, 114+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared interior lateral:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredIntLateral, 'B,R,T', 0, '');

    $CI->F_pdf->SetXY(15, 120+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared interior frontal:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredIntFrontal, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 120+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Piso interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_pisoInt, 'R', 0, '');

    $CI->F_pdf->SetXY(15, 126+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoInt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 126+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Sin olores:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_olores, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 132+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin plagas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_plagas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 132+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Exceso de tierra y lodo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_excesoTierraLodo, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 138+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin basura"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_basura, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 138+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida largo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medLargo . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 144+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Medida ancho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 6, "", 'B', 0, '');
    } else {
        $CI->F_pdf->Cell(0, 6, $SR_medAncho . " ft", 'B', 0, '');
    }

    $CI->F_pdf->SetXY(100, 144+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida alto:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medAlto . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 150+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sellos VVTT:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_selloVVTT, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 150+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Sellos:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetXY(112, 150+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(88, 6, $sellosSemi, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 156+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Número de placas:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_numPlacas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 156+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 6, utf_decode("Estado de la placa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(60, 6, $SR_estadoPlaca, 'B,R', 0, '');


    $CI->F_pdf->SetXY(0, 162+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Firmas"), 0, 1, 'C');

    $fotosArray = array();
    foreach ($imagenes as $imagen) {
        $tipoImagen = substr($imagen->nombre_archivo, 0, 1);
        $numeroImagen = substr($imagen->nombre_archivo, 14, 2);

        if ($tipoImagen == 'S') {
            if ($numeroImagen == '01') {
                $firmaGuardia = $rutaServerFolio . $imagen->nombre_archivo;
            } elseif ($numeroImagen == '02') {
                $firmaOperador = $rutaServerFolio . $imagen->nombre_archivo;
            } elseif ($numeroImagen == '03') {
                $firmaSupervisor = $rutaServerFolio . $imagen->nombre_archivo;
            }
        } elseif ($tipoImagen == 'T') {
            switch ($numeroImagen) {
                case '05':
                    $trazo1 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
            }
        } elseif ($tipoImagen == 'F') {
            array_push($fotosArray, $rutaServerFolio . $imagen->nombre_archivo);
        }
    }
    for ($i = count($fotosArray); $i <= 10; $i++) {
        array_push($fotosArray, $GLOBALS['rutaServer'] . 'blanco.png');
    }

    if (isset($firmaSupervisor) && isset($firmaGuardia)) {
        $CI->F_pdf->SetXY(9, 170+$aumento_y);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(91, 5, utf_decode("Guardia inspección"), 'L,T,B', 2, 'C');
        $CI->F_pdf->Cell(91, 30, " ", 'L,B', 2, 'C');
        $CI->F_pdf->Image($firmaGuardia, 35, 178+$aumento_y, 50, 20);

        $CI->F_pdf->SetXY(100, 170+$aumento_y);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Supervisor"), 'T,L,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 125, 178+$aumento_y, 50, 20);
    } else {
        $CI->F_pdf->SetXY(56, 170+$aumento_y);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(91, 5, utf_decode("Guardia inspección"), 'L,T,B,R', 2, 'C');
        $CI->F_pdf->Cell(91, 30, " ", 'L,B,R', 2, 'C');
        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 75, 180+$aumento_y, 50, 20);
        }
    }


    $CI->F_pdf->SetXY(0, 205+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Trazado"), 0, 1, 'C');

    if (isset($trazo1)) {
        $CI->F_pdf->Image($trazo1, 71, 213+$aumento_y, 58, 40);
    }

    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(0, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Fotos"), 0, 1, 'C');

    $CI->F_pdf->Image($fotosArray[0], 15, 25, 58, 40);
    $CI->F_pdf->Image($fotosArray[1], 75, 25, 58, 40);
    $CI->F_pdf->Image($fotosArray[2], 135, 25, 58, 40);
    $CI->F_pdf->Image($fotosArray[3], 15, 68, 58, 40);
    $CI->F_pdf->Image($fotosArray[4], 75, 68, 58, 40);
    $CI->F_pdf->Image($fotosArray[5], 135, 68, 58, 40);
    $CI->F_pdf->Image($fotosArray[6], 15, 111, 58, 40);
    $CI->F_pdf->Image($fotosArray[7], 75, 111, 58, 40);
    $CI->F_pdf->Image($fotosArray[8], 135, 111, 58, 40);
    $CI->F_pdf->Image($fotosArray[9], 15, 144, 58, 40);



    return $CI->F_pdf->Output("reporte_Inspeccion.pdf", 'I', false);
}
