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


function pdf_formato_inspeccionDoble_usu_insp($post)
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

        $compania_semirremolque = strtoupper($row->CompaniaSemirremolque);
        $marca_semirremolque = strtoupper($row->MarcaSemirremolque);
        $anio_semirremolque = $row->AnioSemirremolque;
        $num_serie_semi = strtoupper(utf_decode($row->NumSerieSemi));
        $num_econ_semi = strtoupper($row->NumEconSemi);
        $tipo_semirremolque = strtoupper($row->TipoSemirremolque);
        $temp_semi = utf_decode($row->TemperaturaSemi);
        $nivel_combust_semi = utf_decode($row->NivelCombustSemi);
        $sellosSemi = strtoupper(utf_decode($row->sellosSemi));

        $compania_semirremolque2 = strtoupper($row->CompaniaSemirremolque2);
        $marca_semirremolque2 = strtoupper($row->MarcaSemirremolque2);
        $anio_semirremolque2 = $row->AnioSemirremolque2;
        $num_serie_semi2 = strtoupper(utf_decode($row->NumSerieSemi2));
        $num_econ_semi2 = strtoupper($row->NumEconSemi2);
        $tipo_semirremolque2 = strtoupper($row->TipoSemirremolque2);
        $temp_semi2 = utf_decode($row->TemperaturaSemi2);
        $nivel_combust_semi2 = utf_decode($row->NivelCombustSemi2);
        $sellosSemi2 = strtoupper(utf_decode($row->sellosSemi2));

        $empresa_id = $row->empresa_id;

        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));

        $cajon = strtoupper(utf_decode($row->cajon));

        $estatus_Semi1 = strtoupper(utf_decode($row->estatusSemi));
        $estatus_Semi2 = strtoupper(utf_decode($row->estatusSemi2));
    }
    $queryInspeccionDetalles = $CI->db->get_where('inspecciones_detalles', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccionDetalles->result() as $row) {
        if ($row->numSemi == 1) {
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
            $SR_pernoRey = siglasToCompleto($row->SR_pernoRey);
            $SR_paredLatExt = siglasToCompleto($row->SR_paredLatExt);
            $SR_chasisPisoExt = siglasToCompleto($row->SR_chasisPisoExt);
            $SR_llantasTraserasIzq = siglasToCompleto($row->SR_llantasTraserasIzq);
            $SR_puertaPartExt = siglasToCompleto($row->SR_puertaPartExt);
            $SR_puertasInt = siglasToCompleto($row->SR_puertasInt);
            $SR_bisagras = siglasToCompleto($row->SR_bisagras);
            $SR_mecanCierre = siglasToCompleto($row->SR_mecanCierre);
            $SR_defensa = siglasToCompleto($row->SR_defensa);
            $SR_luzTrasExtIzq = siglasToCompleto($row->SR_luzTrasExtIzq);
            $SR_luzTrasExtDer = siglasToCompleto($row->SR_luzTrasExtDer);
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
            $SR_luzTrasDer = siglasToCompleto($row->SR_luzTrasDer);
            $SR_llantasTraserasDer = siglasToCompleto($row->SR_llantasTraserasDer);
            $SR_techoExt = siglasToCompleto($row->SR_techoExt);
            $SR_paredLatExtDer = siglasToCompleto($row->SR_paredLatExtDer);
            $SR_paredExtFrontal = siglasToCompleto($row->SR_paredExtFrontal);
            $TC_luzDirTrasDer = siglasToCompleto($row->TC_luzDirTrasDer);
            $SR_unidadRefrig = siglasToCompleto($row->SR_unidadRefrig);
            $TC_luzTrasDer = siglasToCompleto($row->TC_luzTrasDer);
            $TC_LlantasTraserasDer = siglasToCompleto($row->TC_LlantasTraserasDer);
            $TC_escape = siglasToCompleto($row->TC_escape);
            $TC_motor = siglasToCompleto($row->TC_motor);
            $TC_luzDireccDelantDer = siglasToCompleto($row->TC_luzDireccDelantDer);
            $TC_LlantasDelantDer = siglasToCompleto($row->TC_LlantasDelantDer);
            $comentInsp = ($row->comentInsp);
        } else {

            $SR_pernoRey2 = siglasToCompleto($row->SR_pernoRey);
            $SR_paredLatExt2 = siglasToCompleto($row->SR_paredLatExt);
            $SR_chasisPisoExt2 = siglasToCompleto($row->SR_chasisPisoExt);
            $SR_llantasTraserasIzq2 = siglasToCompleto($row->SR_llantasTraserasIzq);
            $SR_puertaPartExt2 = siglasToCompleto($row->SR_puertaPartExt);
            $SR_puertasInt2 = siglasToCompleto($row->SR_puertasInt);
            $SR_bisagras2 = siglasToCompleto($row->SR_bisagras);
            $SR_mecanCierre2 = siglasToCompleto($row->SR_mecanCierre);
            $SR_defensa2 = siglasToCompleto($row->SR_defensa);
            $SR_luzTrasExtIzq2 = siglasToCompleto($row->SR_luzTrasExtIzq);
            $SR_luzTrasExtDer2 = siglasToCompleto($row->SR_luzTrasExtDer);
            $SR_paredIntLateral2 = siglasToCompleto($row->SR_paredIntLateral);
            $SR_paredIntFrontal2 = siglasToCompleto($row->SR_paredIntFrontal);
            $SR_pisoInt2 = siglasToCompleto($row->SR_pisoInt);
            $SR_techoInt2 = siglasToCompleto($row->SR_techoInt);
            $SR_olores2 = siglasToCompleto($row->SR_olores);
            $SR_plagas2 = siglasToCompleto($row->SR_plagas);
            $SR_excesoTierraLodo2 = siglasToCompleto($row->SR_excesoTierraLodo);
            $SR_basura2 = siglasToCompleto($row->SR_basura);
            $SR_medLargo2 = $row->SR_medLargo;
            $SR_medAncho2 = $row->SR_medAncho;
            $SR_medAlto2 = ($row->SR_medAlto);
            $SR_puertaInt2 = siglasToCompleto($row->SR_puertaInt);
            $SR_selloVVTT2 = siglasToCompleto($row->SR_selloVVTT);
            $SR_numPlacas2 = ($row->SR_numPlacas);
            $SR_estadoPlaca2 = utf_decode($row->SR_estadoPlaca);
            $SR_luzTrasDer2 = siglasToCompleto($row->SR_luzTrasDer);
            $SR_llantasTraserasDer2 = siglasToCompleto($row->SR_llantasTraserasDer);
            $SR_techoExt2 = siglasToCompleto($row->SR_techoExt);
            $SR_paredLatExtDer2 = siglasToCompleto($row->SR_paredLatExtDer);
            $SR_paredExtFrontal2 = siglasToCompleto($row->SR_paredExtFrontal);
            $SR_unidadRefrig2 = siglasToCompleto($row->SR_unidadRefrig);
        }
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

    $tipoInspeccion = str_replace("Doble ", "", $tipoInspeccion);

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
    $CI->F_pdf->SetXY(100, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(42, 8, utf_decode("Marca del tractocamión: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_tracto, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(25, 8, utf_decode("Comentarios: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $comentarios_tracto, 'T,B,R', 2, '');

    $CI->F_pdf->SetXY(100, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Vigencia de Licencia: "), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $fecha_vigencia, 0, 1, '');

    $CI->F_pdf->SetXY(100, 70);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(25, 8, utf_decode("TC Nº Placas:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_placas_tracto, 0, 1, '');


    /* DATOS SEMIRREMOLQUE 1 */

    $CI->F_pdf->SetXY(10, 94);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("SEMIRREMOLQUE 1"), 0, 1, 'C');
    $CI->F_pdf->SetXY(15, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(12, 8, utf_decode("Línea: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $compania_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 110);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Marca del Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 118);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Semirremolque No Eco: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_semi, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_semi, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Tipo de Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tipo_semirremolque, 'T,B,R', 1, '');

    $CI->F_pdf->SetXY(100, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Estatus:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $estatus_Semi1, 0, 1, '');
    $CI->F_pdf->SetXY(100, 110);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Año semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $anio_semirremolque, 0, 1, '');
    $CI->F_pdf->SetXY(100, 118);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nº serie semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_serie_semi, 0, 1, '');
    $CI->F_pdf->SetXY(100, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Temperatura semirremolque: "), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $temp_semi, 0, 1, '');
    /* DETALLES SEMI 1 */
    $CI->F_pdf->SetXY(10, 142);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE 1"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 150);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Perno rey y palanca:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_pernoRey, 'B,T', 0, '');

    $CI->F_pdf->SetXY(100, 150);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral externa lado izquierdo"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, utf_decode($SR_paredLatExt), "B,R,T", 0, 'L');

    $CI->F_pdf->SetXY(15, 156);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Chasis y piso exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 156);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq, 'R', 0, 'L');

    $CI->F_pdf->SetXY(15, 162);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Puertas parte exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_puertaPartExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 162);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Puertas parte interior:"), 'L,,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_puertaInt, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 168);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Bisagras:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 168);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Mecanismo de cierre:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Defensa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_defensa, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_luzTrasExtIzq, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 180);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasExtDer, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 180);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared interior lateral:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredIntLateral, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 186);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared interior frontal:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredIntFrontal, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 186);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Piso interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_pisoInt, 'R', 0, '');

    $CI->F_pdf->SetXY(15, 192);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoInt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 192);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Sin olores:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_olores, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin plagas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_plagas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Exceso de tierra y lodo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_excesoTierraLodo, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 204);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin basura"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_basura, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 204);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida largo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medLargo . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 210);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Medida ancho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 6, "", 'B', 0, '');
    } else {
        $CI->F_pdf->Cell(0, 6, $SR_medAncho . " ft", 'B', 0, '');
    }

    $CI->F_pdf->SetXY(100, 210);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida alto:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medAlto . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 216);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sellos VVTT:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_selloVVTT, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 216);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Número de sellos:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $sellosSemi, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 222);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Número de placas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_numPlacas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 222);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Nombre del estado de la placa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_estadoPlaca, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 228);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasDer, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 228);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 234);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 234);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral exterior lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredLatExtDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 240);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared exterior frontal:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredExtFrontal, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 240);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Unidad refrigerada:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_unidadRefrig, 'B,R', 0, '');


    /* DATOS SEMIRREMOLQUE 2 */
    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(10, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("SEMIRREMOLQUE 2"), 0, 1, 'C');
    $CI->F_pdf->SetXY(15, 23);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(12, 8, utf_decode("Línea: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $compania_semirremolque2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 31);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Marca del Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_semirremolque2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 39);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Semirremolque No Eco: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_semi2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 47);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_semi2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 55);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Tipo de Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tipo_semirremolque2, 'T,B,R', 1, '');

    $CI->F_pdf->SetXY(100, 23);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Estatus:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $estatus_Semi2, 0, 1, '');
    $CI->F_pdf->SetXY(100, 31);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Año semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $anio_semirremolque2, 0, 1, '');
    $CI->F_pdf->SetXY(100, 39);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nº serie semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_serie_semi2, 0, 1, '');
    $CI->F_pdf->SetXY(100, 47);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Temperatura semirremolque: "), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $temp_semi2, 0, 1, '');

    /* Semirremolques 2 */

    $CI->F_pdf->SetXY(10, 63);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE 2"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 74);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Perno rey y palanca:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_pernoRey2, 'B,T', 0, '');

    $CI->F_pdf->SetXY(100, 74);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral externa lado izquierdo"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, utf_decode($SR_paredLatExt2), "B,R,T", 0, 'L');

    $CI->F_pdf->SetXY(15, 80);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Chasis y piso exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 80);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq2, 'R', 0, 'L');

    $CI->F_pdf->SetXY(15, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Puertas parte exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_puertaPartExt2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Puertas parte interior:"), 'L,,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_puertaInt2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 92);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Bisagras:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 92);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Mecanismo de cierre:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 98);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Defensa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_defensa2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 98);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_luzTrasExtIzq2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 104);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasExtDer2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 104);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared interior lateral:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredIntLateral2, 'B,R', 0, '');


    $CI->F_pdf->SetXY(15, 110);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared interior frontal:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredIntFrontal2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 110);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Piso interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_pisoInt2, 'R', 0, '');

    $CI->F_pdf->SetXY(15, 116);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoInt2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 116);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Sin olores:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_olores2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 122);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin plagas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_plagas2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 122);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Exceso de tierra y lodo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_excesoTierraLodo2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin basura"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_basura2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida largo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medLargo2 . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Medida ancho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 6, "", 'B', 0, '');
    } else {
        $CI->F_pdf->Cell(0, 6, $SR_medAncho2 . " ft", 'B', 0, '');
    }

    $CI->F_pdf->SetXY(100, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida alto:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medAlto2 . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 140);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sellos VVTT:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_selloVVTT2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 140);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Número de sellos:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $sellosSemi2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 146);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Número de placas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_numPlacas2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 146);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Nombre del estado de la placa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_estadoPlaca2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 152);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasDer2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 152);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasDer2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 158);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoExt2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 158);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral exterior lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredLatExtDer2, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 164);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared exterior frontal:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredExtFrontal2, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 164);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Unidad refrigerada:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_unidadRefrig2, 'B,R', 0, '');




    $CI->F_pdf->SetXY(0, 172);
    $CI->F_pdf->SetFont('Arial', 'B', 13);
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
        } elseif ($tipoImagen == 'F') {
            array_push($fotosArray, $rutaServerFolio . $imagen->nombre_archivo);
        }
    }
    for ($i = count($fotosArray); $i <= 10; $i++) {
        array_push($fotosArray, $GLOBALS['rutaServer'] . 'blanco.png');
    }

    if (isset($firmaSupervisor)) {

        $CI->F_pdf->SetXY(15, 180);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(40, 5, utf_decode("Guardia"), 'T,B,L', 2, 'C');

        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 15, 190, 35, 10);
        }

        $CI->F_pdf->SetXY(30, 180);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(140, 5, utf_decode("Operador"), 'T,B', 2, 'C');
        if (isset($firmaOperador)) {
            $CI->F_pdf->Image($firmaOperador, 83, 190, 35, 10);
        }

        $CI->F_pdf->SetXY(140, 180);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(0, 5, utf_decode("Supervisor"), 'T,R,B', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 150, 190, 35, 10);
    } else {
        $CI->F_pdf->SetXY(15, 180);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(91, 5, utf_decode("Guardia"), 'L,T,B', 2, 'C');
        $CI->F_pdf->Cell(91, 20, " ", 'L,B', 2, 'C');
        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 40, 190, 35, 10);
        }

        $CI->F_pdf->SetXY(100, 180);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Operador"), 'L,T,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 20, " ", 'L,B,R', 2, 'C');
        if (isset($firmaOperador)) {
            $CI->F_pdf->Image($firmaOperador, 130, 190, 35, 10);
        }
    }





    return $CI->F_pdf->Output("reporte_InspeccionDobleSemi.pdf", 'I', false);
}
