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

function pdf_formato_inspeccion($post)
{
    $CI = &get_instance();
    $CI->load->database();

    $inspeccionID = $post['inspeccionID'];
    $es_transportista = $post['es_transportista'];
    $queryInspeccion = $CI->db->get_where('vw_inspecciones', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccion->result() as $row) {
        $folio = $row->Folio;
        $tipoInspeccion = $row->TipoInspeccion;
        $fecha_inspeccion = $row->FechaInspeccion;
        $hora_inspeccion = substr($row->HoraInspeccion, 0, 5);
        $tipo_movimiento = utf_decode($row->TipoMovimiento);
        $tiempo_inspeccion = $row->tiempo_inspeccion;
        $nombre_usuario_ins = strtoupper(utf_decode($row->nombreUsuarioInspCompleto));
        $nombre_operador = strtoupper(utf_decode($row->nombreOpCompleto));
        $telefono = $row->telefono_ope;
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
        $compania_semirremolque = strtoupper(utf_decode($row->CompaniaSemirremolque));
        $marca_semirremolque = strtoupper(utf_decode($row->MarcaSemirremolque));
        $anio_semirremolque = $row->AnioSemirremolque;
        $num_serie_semi = strtoupper(utf_decode($row->NumSerieSemi));
        $num_econ_semi = strtoupper($row->NumEconSemi);
        $tipo_semirremolque = strtoupper(utf_decode($row->TipoSemirremolque));
        $temp_semi = utf_decode($row->TemperaturaSemi);
        $nivel_combust_semi = utf_decode($row->NivelCombustSemi);
        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));
        $sellosSemi = strtoupper(utf_decode($row->sellosSemi));
        $sellosSemi2 = strtoupper(utf_decode($row->sellosSemi2));
        $cajon = strtoupper(utf_decode($row->cajon));
        $estatus_Semi1 = strtoupper(utf_decode($row->estatusSemi));

        $num_gps = $row->num_gps;
        $num_gafete = $row->numControlOp;
        $autoriza = $row->autoriza_por_monitoreo;

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
        $comentInsp = utf_decode($row->comentInsp);
    }

    $queryInspeccionLlantas = $CI->db->get_where('vw_llantasconmarcas', array('InspeccionID' => $inspeccionID));
    $llantas = $queryInspeccionLlantas->result();

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
        $CI->F_pdf->SetXY(60, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("HORA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $hora_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(97, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("TIEMPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tiempo_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(135, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    } else {
        $CI->F_pdf->Cell(16.5, 8, utf_decode("FECHA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $fecha_inspeccion, 'T,B', 0, 'L');
        $CI->F_pdf->SetXY(51, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("HORA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $hora_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(77, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(18, 8, utf_decode("TIEMPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tiempo_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(112, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(16.5, 8, utf_decode("CAJÓN: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetXY(126, 30);
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $cajon, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(136, 30);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    }

    $CI->F_pdf->SetXY(15, 38);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre guardia: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_usuario_ins, 'B,R', 1, '');
    $CI->F_pdf->SetXY(15, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre operador: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_operador, 'B,R', 1, '');
    $CI->F_pdf->SetXY(150, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Teléfono Op: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetXY(173, 46);
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $telefono, 'B,R', 0, '');
    $CI->F_pdf->SetXY(15, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("No. de Licencia: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $numero_licencia, 'R', 1, '');
    $CI->F_pdf->SetXY(15, 62);
    $CI->F_pdf->SetFont('Arial', 'B', 10);

    if (strpos($tipoInspeccion, "Entrada") !== false) {
        $CI->F_pdf->Cell(50, 8, utf_decode("Procedencia: "), 'L,B', 0, 'L');
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $procedencia, 'T,B,R', 1, '');
    } else {
        $CI->F_pdf->Cell(50, 8, utf_decode("Destino: "), 'L,B', 0, 'L');
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $procedencia, 'T,B,R', 1, '');
    }

    $CI->F_pdf->SetXY(15, 70);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Cliente: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $cliente, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Línea transportista: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $proveedor, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("TC Nº económico: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_tracto, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 94);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("TC Tarjeta de circulación: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tarjeta_circ_tracto, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Marca del tractocamión: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_tracto, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 110);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Línea Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $compania_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 118);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Marca del Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Semirremolque No Eco: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_semi, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Tipo de Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tipo_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 142);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_semi, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 150);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(30, 8, utf_decode("Comentarios: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $comentarios_tracto, 'T,B,R', 2, '');

    $CI->F_pdf->SetXY(100, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Vigencia Licencia: "), 'L', 0, 'L');
    $CI->F_pdf->SetXY(132, 54);
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $fecha_vigencia, 0, 1, '');

    $CI->F_pdf->SetXY(100, 94);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("TC Nº Placas:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_placas_tracto, 0, 1, '');
    $CI->F_pdf->SetXY(100, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_tracto, 'T,B,R', 1, '');

    $aumento_y = 2;
    $aumento_y_tabla = 0;
    if ($es_transportista == 3) {
        $aumento_y_tabla = 6;
        $aumento_y = 8;

        $CI->F_pdf->SetXY(150, 54);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(30, 8, utf_decode("No. Gafete: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetXY(170, 54);
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $num_gafete, 'T,B,R', 2, '');

        $CI->F_pdf->SetXY(15, 158);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(30, 8, utf_decode("No. GPS: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetXY(31, 158);
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $num_gps, 'T,B,R', 2, '');

        $CI->F_pdf->SetXY(15, 166);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(42, 8, utf_decode("Autoriza por monitoreo: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetXY(56, 166);
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $autoriza, 'T,B,R', 2, '');
    }

    $CI->F_pdf->SetXY(100, 118);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Estatus:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $estatus_Semi1, 0, 1, '');
    $CI->F_pdf->SetXY(100, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Año semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $anio_semirremolque, 0, 1, '');
    $CI->F_pdf->SetXY(100, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nº serie semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_serie_semi, 0, 1, '');
    $CI->F_pdf->SetXY(100, 142);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Temperatura semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $temp_semi, 0, 1, '');

    $CI->F_pdf->SetXY(10, 166+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL TRACTOCAMIÓN"), 0, 1, 'C');
    
    $CI->F_pdf->SetXY(15, 174+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Izquierdo:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_izq, 'T,B', 1, '');
    $CI->F_pdf->SetXY(73, 174+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Derecho:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_der, 'T,B', 1, '');
    $CI->F_pdf->SetXY(130, 174+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 8, utf_decode("Llantas baja presión:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $llantas_baja_presion, 'T,B,R', 1, '');

    $CI->F_pdf->SetXY(15, 184+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Defensa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_defensa, 'B,T', 0, '');

    $CI->F_pdf->SetXY(100, 184+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(72, 6, utf_decode("Luces direccionales delanteras izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(28, 6, utf_decode($TC_luzDireccDelantIzq), "B,R,T", 0, 'L');

    $CI->F_pdf->SetXY(15, 190+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Llantas delanteras izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_LlantasDelantIzq, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 190+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Techo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_Techo, 'R', 0, 'L');

    $CI->F_pdf->SetXY(15, 196+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Piso interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_PisoInter, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 196+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Cabina y camarote:"), 'L,,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_cabinaCamarote, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 202+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Área equipaje herramienta:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_equipHerram, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 202+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Sin plagas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_sinPlagas, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 208+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin basura:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_basura, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 208+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Tanque de Diesel:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_tanqDiesel, 'B,R', 0, '');


    $CI->F_pdf->SetXY(15, 214+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Tanque de aire:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_tanqAire, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 214+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Quinta rueda:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_quintaRueda, 'R', 0, '');

    $CI->F_pdf->SetXY(15, 220+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Chasis y piso exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_chasisPisoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 220+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_LlantasTraserasIzq, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 226+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_LuzTrasIzq, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 226+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Luz direccional trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_luzDirTrasDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 232+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $TC_luzTrasDer, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 232+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $TC_LlantasTraserasDer, 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 238+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Escape:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 6, "", 'B', 0, '');
    } else {
        $CI->F_pdf->Cell(0, 6, $TC_escape, 'B', 0, '');
    }

    $CI->F_pdf->SetXY(100, 238+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Motor:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $TC_motor, 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 244+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sellos VVTT:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_selloVVTT, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 244+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas delanteras lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $TC_LlantasDelantDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 250+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Comentarios:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, utf_decode($comentarios_tracto), 'B,R', 0, '');

   /*SEMIRREMOLQUE*/ 

    $CI->F_pdf->Addpage();

    $CI->F_pdf->SetXY(10, 16);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 24);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Perno rey y palanca:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_pernoRey, 'B,T', 0, '');

    $CI->F_pdf->SetXY(100, 24);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral externa lado izquierdo"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, utf_decode($SR_paredLatExt), "B,R,T", 0, 'L');

    $CI->F_pdf->SetXY(15, 30);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Chasis y piso exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 30);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq, 'R', 0, 'L');

    $CI->F_pdf->SetXY(15, 36);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Puertas parte exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_puertaPartExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 36);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Puertas parte interior:"), 'L,,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_puertaInt, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 42);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Bisagras:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 42);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Mecanismo de cierre:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 48);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Defensa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_defensa, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 48);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_luzTrasExtIzq, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasExtDer, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared interior lateral:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredIntLateral, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 60);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared interior frontal:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredIntFrontal, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 60);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Piso interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_pisoInt, 'R', 0, '');

    $CI->F_pdf->SetXY(15, 66);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoInt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 66);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Sin olores:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_olores, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 72);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin plagas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_plagas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 72);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Exceso de tierra y lodo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_excesoTierraLodo, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin basura"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_basura, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida largo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medLargo . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 84);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Medida ancho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 6, "", 'B', 0, '');
    } else {
        $CI->F_pdf->Cell(0, 6, $SR_medAncho . " ft", 'B', 0, '');
    }

    $CI->F_pdf->SetXY(100, 84);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida alto:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medAlto . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 90);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sellos VVTT:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_selloVVTT, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 90);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Número de sellos:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetXY(131, 90);
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(69, 6, $sellosSemi, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 96);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Número de placas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_numPlacas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 96);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 6, utf_decode("Estado de la placa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(60, 6, $SR_estadoPlaca, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasDer, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 108);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 108);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral exterior lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredLatExtDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 114);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared exterior frontal:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredExtFrontal, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 114);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Unidad refrigerada:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_unidadRefrig, 'B,R', 0, '');
    /* Inspeccion de llantas */

    $llantasArray = array();
    for ($i = 1; $i <= 18; $i++) {
        foreach ($llantas as $llanta) {
            if ($i == $llanta->numLlanta) {
                array_push($llantasArray, $llanta->Nombre);
                break;
            }
        }
        if (count($llantasArray) < $i) {
            array_push($llantasArray, "");
        }
    }

    $CI->F_pdf->SetXY(10, 119);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Marcas de llantas"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 127);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 1:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[0], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 133);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 2:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[1], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 139);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 3:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[2], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 145);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 4:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[3], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 151);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 5:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[4], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 157);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 6:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[5], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 163);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 7:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[6], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 169);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 6:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[7], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 175);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 9:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[6], 'T,R,B', 1, '');


    $CI->F_pdf->SetXY(100, 127);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 10:"), 'L', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[9], 0, 1, '');
    $CI->F_pdf->SetXY(100, 133);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 11:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[10], 0, 1, '');
    $CI->F_pdf->SetXY(100, 139);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 12:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[11], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 145);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 13:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[12], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 151);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 14:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[13], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 157);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 15:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[14], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 163);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 16:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[15], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 169);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 17:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[16], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 175);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 6, utf_decode("Marca 16:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 6, $llantasArray[17], 'T,R,B', 1, '');


    $CI->F_pdf->SetXY(0, 182);
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
                case '01':
                    $trazo1 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
                case '02':
                    $trazo2 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
                case '03':
                    $trazo3 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
                case '04':
                    $trazo4 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
                case '05':
                    $trazo5 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
                case '06':
                    $trazo6 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
                case '07':
                    $trazo7 = $rutaServerFolio . $imagen->nombre_archivo;
                    break;
            }
        } elseif ($tipoImagen == 'F') {
            array_push($fotosArray, $rutaServerFolio . $imagen->nombre_archivo);
        }
    }
    for ($i = count($fotosArray); $i <= 10; $i++) {
        array_push($fotosArray, $GLOBALS['rutaServer'] . 'blanco.png');
    }

    $CI->F_pdf->SetXY(9, 190);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(91, 5, utf_decode("Guardia"), 'L,T,B', 2, 'C');
    $CI->F_pdf->Cell(91, 30, " ", 'L,B', 2, 'C');
    if (isset($firmaGuardia)) {
        $CI->F_pdf->Image($firmaGuardia, 25, 200, 50, 20);
    }

    $CI->F_pdf->SetXY(100, 190);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(100, 5, utf_decode("Operador"), 'L,T,R,B', 2, 'C');
    $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
    if (isset($firmaOperador)) {
        $CI->F_pdf->Image($firmaOperador, 130, 200, 50, 20);
    }

    if (isset($firmaSupervisor)) {
        $CI->F_pdf->SetXY(50, 225);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Supervisor"), 'L,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 75, 235, 50, 20);
    }

    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(0, 10);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Trazados"), 0, 1, 'C');

    if (!isset($trazo7)) {
        $trazo7 = $GLOBALS['rutaDefault'] . "tractor_blanco_derecha.png";
    }
    if (!isset($trazo6)) {
        $trazo6 = $GLOBALS['rutaDefault'] . "tractor_blanco.png";
    }
    if (!isset($trazo1)) {
        $trazo1 = $GLOBALS['rutaDefault'] . "caja_izquierda.png";
    }
    if (!isset($trazo3)) {
        $trazo3 = $GLOBALS['rutaDefault'] . "caja_derecha.png";
    }
    if (!isset($trazo4)) {
        $trazo4 = $GLOBALS['rutaDefault'] . "caja_arriba.png";
    }
    if (!isset($trazo2)) {
        $trazo2 = $GLOBALS['rutaDefault'] . "caja_atras.png";
    }
    if (!isset($trazo5)) {
        $trazo5 = $GLOBALS['rutaDefault'] . "caja_interior.png";
    }

    $CI->F_pdf->Image($trazo7, 25, 20, 58, 40);
    $CI->F_pdf->Image($trazo6, 86, 20, 58, 40);
    $CI->F_pdf->Image($trazo1, 25, 64, 58, 40);
    $CI->F_pdf->Image($trazo3, 86, 64, 58, 40);
    $CI->F_pdf->Image($trazo4, 153, 64, 19, 80);
    $CI->F_pdf->Image($trazo2, 25, 106, 57, 40);
    $CI->F_pdf->Image($trazo5, 86, 106, 57, 40);

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
