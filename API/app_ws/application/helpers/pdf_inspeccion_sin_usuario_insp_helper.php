<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];




function llantasBajaPresion($a)
{
    if ((int)$a == 0) {
        return "NO";
    } else if ((int)$a == 1) {
        return "SI";
    } else {
        return '';
    }
}

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


function pdf_formato_inspeccionSin_usu_insp($post)
{
    $CI = &get_instance();
    $CI->load->database();

    $inspeccionID = $post['inspeccionID'];
    $queryInspeccion = $CI->db->get_where('vw_inspecciones', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccion->result() as $row) {
        $folio = $row->Folio;
        $tipoInspeccion = $row->TipoInspeccion;
        $fecha_inspeccion = $row->FechaInspeccion;
        $hora_inspeccion = substr($row->HoraInspeccion, 0, 5);
        $tipo_movimiento = utf_decode($row->TipoMovimiento);
        $nombre_usuario_ins = strtoupper(utf_decode($row->nombreUsuarioInspCompleto));
        $nombre_operador = strtoupper(utf_decode($row->nombreOpCompleto));
        $numero_licencia = $row->NumeroLicencia;
        $fecha_vigencia = $row->FechaVigencia;
        $procedencia = utf_decode(strtoupper($row->Procedencia));
        $cliente = strtoupper(utf_decode($row->Cliente));
        $proveedor = strtoupper(utf_decode($row->Proveedor));
        $num_econ_tracto = strtoupper($row->NumEconomicoTracto);
        $num_placas_tracto = strtoupper($row->NumPlacasTracto);
        $tarjeta_circ_tracto = strtoupper($row->TarjetaCircTracto);
        $marca_tracto = strtoupper($row->MarcaTracto);
        $nivel_combust_tracto = utf_decode($row->nivelCombustTracto);
        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));
        $cajon = strtoupper(utf_decode($row->cajon));

        $empresa_id = $row->empresa_id;
    }
    $queryInspeccionDetalles = $CI->db->get_where('inspecciones_detalles', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccionDetalles->result() as $row) {
        $espejo_lat_izq = $row->espejoLatIzq;
        $espejo_lat_der = $row->espejoLatDer;
        $llantas_baja_presion = llantasBajaPresion($row->llantasBajaPresion);
        $comentarios_tracto = $row->comentariosTracto;
        $TC_defensa = siglasToCompleto($row->TC_defensa);
        $TC_luzDireccDelantIzq = siglasToCompleto($row->TC_luzDireccDelantIzq);
        $TC_LlantasDelantIzq = siglasToCompleto($row->TC_LlantasDelantIzq);
        $TC_Techo = siglasToCompleto($row->TC_Techo);
        $TC_PisoInter = siglasToCompleto($row->TC_PisoInter);
        $TC_cabinaCamarote = siglasToCompleto($row->TC_cabinaCamarote);
        $TC_equipHerram = siglasToCompleto($row->TC_equipHerram);
        $TC_sinPlagas = siglasToCompleto($row->TC_sinPlagas);
        $TC_basura = siglasToCompleto($row->TC_basura);
        $TC_tanqDiesel = siglasToCompleto($row->TC_tanqDiesel);
        $TC_tanqAire = siglasToCompleto($row->TC_tanqAire);
        $TC_quintaRueda = siglasToCompleto($row->TC_quintaRueda);
        $TC_chasisPisoExt = siglasToCompleto($row->TC_chasisPisoExt);
        $TC_LlantasTraserasIzq = siglasToCompleto($row->TC_LlantasTraserasIzq);
        $TC_LuzTrasIzq = siglasToCompleto($row->TC_LuzTrasIzq);
        $TC_luzDirTrasDer = siglasToCompleto($row->TC_luzDirTrasDer);
        $TC_luzTrasDer = siglasToCompleto($row->TC_luzTrasDer);
        $TC_LlantasTraserasDer = siglasToCompleto($row->TC_LlantasTraserasDer);
        $TC_escape = siglasToCompleto($row->TC_escape);
        $TC_motor = siglasToCompleto($row->TC_motor);
        $TC_luzDireccDelantDer = siglasToCompleto($row->TC_luzDireccDelantDer);
        $TC_LlantasDelantDer = siglasToCompleto($row->TC_LlantasDelantDer);
        $comentInsp = ($row->comentInsp);
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
    $CI->F_pdf->MultiCell(0, 4, utf_decode("INSPECCIÓN DE CONTENEDORES"), '0', 'C', false);

    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(90, 8, "FOLIO: ", 0, 0, 'R');
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->SetTextColor(255, 0, 0);
    $CI->F_pdf->Cell(70, 8, $folio, 0, 1, '');

    $CI->F_pdf->SetXY(13, 21);
    $CI->F_pdf->SetDrawColor(192, 192, 192);
    $CI->F_pdf->SetTextColor(0, 0, 0);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 6, utf_decode($tipoInspeccion), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 30);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    if ($cajon == "") {
        $CI->F_pdf->Cell(20, 8, utf_decode("FECHA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $fecha_inspeccion, 'T,B', 1, '');
        $CI->F_pdf->SetXY(75, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("HORA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $hora_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(130, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    } else {
        $CI->F_pdf->Cell(20, 8, utf_decode("FECHA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $fecha_inspeccion, 'T,B', 1, '');
        $CI->F_pdf->SetXY(60, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("HORA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $hora_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(97, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("CAJÓN: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $cajon, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(135, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    }

    $CI->F_pdf->SetXY(15, 38);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(18, 8, utf_decode("Guardia: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_usuario_ins, 'B,R', 1, '');
    $CI->F_pdf->SetXY(100, 38);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Operador: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_operador, 'B,R', 1, '');
    $CI->F_pdf->SetXY(15, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(30, 8, utf_decode("No. de Licencia: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $numero_licencia, 'B,R', 1, '');
    $CI->F_pdf->SetXY(15, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);

    if (strpos($tipoInspeccion, "Entrada") !== false) {
        $CI->F_pdf->Cell(25, 8, utf_decode("Procedencia: "), 'L,B', 0, 'L');
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $procedencia, 'T,B,R', 1, '');
    } else {
        $CI->F_pdf->Cell(50, 8, utf_decode("Destino: "), 'L,B', 0, 'L');
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $procedencia, 'T,B,R', 1, '');
    }
    $CI->F_pdf->SetXY(100, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(15, 8, utf_decode("Cliente: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $cliente, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 62);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(35, 8, utf_decode("Línea transportista: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $proveedor, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 70);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(35, 8, utf_decode("TC Nº económico: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_tracto, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("TC Tarjeta de circulación: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tarjeta_circ_tracto, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(42, 8, utf_decode("Marca del tractocamión: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_tracto, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 94);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->SetXY(15, 94);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(25, 8, utf_decode("Comentarios: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $comentarios_tracto, 'T,B,R', 2, '');

    $CI->F_pdf->SetXY(100, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Vigencia de Licencia: "), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $fecha_vigencia, 0, 1, '');

    $CI->F_pdf->SetXY(100, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(25, 8, utf_decode("TC Nº Placas:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_placas_tracto, 0, 1, '');
    $CI->F_pdf->SetXY(100, 70);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_tracto, 'T,B,R', 1, '');

    /* Firmas */

    $CI->F_pdf->SetXY(0, 100);
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
        }
        for ($i = count($fotosArray); $i <= 10; $i++) {
            array_push($fotosArray, $GLOBALS['rutaServer'] . 'blanco.png');
        }
    }

    if (isset($firmaSupervisor)) {

        $CI->F_pdf->SetXY(15, 109);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(40, 5, utf_decode("Guardia"), 'T,B,L', 2, 'C');

        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 15, 119, 35, 10);
        }

        $CI->F_pdf->SetXY(30, 109);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(140, 5, utf_decode("Operador"), 'T,B', 2, 'C');
        if (isset($firmaOperador)) {
            $CI->F_pdf->Image($firmaOperador, 83, 119, 35, 10);
        }

        $CI->F_pdf->SetXY(140, 109);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(0, 5, utf_decode("Supervisor"), 'T,R,B', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 150, 119, 35, 10);
    } else {
        $CI->F_pdf->SetXY(15, 109);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(91, 5, utf_decode("Guardia"), 'L,T,B', 2, 'C');
        $CI->F_pdf->Cell(91, 20, " ", 'L,B', 2, 'C');
        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 40, 119, 35, 10);
        }

        $CI->F_pdf->SetXY(100, 109);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Operador"), 'L,T,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 20, " ", 'L,B,R', 2, 'C');
        if (isset($firmaOperador)) {
            $CI->F_pdf->Image($firmaOperador, 130, 119, 35, 10);
        }
    }

    return $CI->F_pdf->Output("reporte_Inspeccion.pdf", 'I', false);
}

