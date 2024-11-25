<?php

$GLOBALS['rutaBase'] = rutaBase();
$GLOBALS['rutaDivisor'] = rutaDivisor();

$GLOBALS['rutaServer'] = $GLOBALS['rutaBase'] . "images" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaLogos'] = $GLOBALS['rutaBase'] . "logos_empresas" . $GLOBALS['rutaDivisor'];
$GLOBALS['rutaDefault'] = $GLOBALS['rutaServer'] . "default" . $GLOBALS['rutaDivisor'];

function pdf_formato_inspeccion($post)
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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

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
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre guardia: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_usuario_ins, 'B,R', 1, '');
    $CI->F_pdf->SetXY(15, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre operador: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_operador, 'B,R', 1, '');
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
    $CI->F_pdf->Cell(50, 8, utf_decode("Vigencia de Licencia: "), 'L', 0, 'L');
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
    /*Tractocamiones */
    $CI->F_pdf->SetXY(10, 157);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL TRACTOCAMIÓN"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 166);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Izquierdo:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_izq, 'T,B', 1, '');
    $CI->F_pdf->SetXY(73, 166);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Derecho:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_der, 'T,B', 1, '');
    $CI->F_pdf->SetXY(130, 166);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 8, utf_decode("Llantas baja presión:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $llantas_baja_presion, 'T,B,R', 1, '');


    $CI->F_pdf->SetXY(15, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Defensa:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_defensa, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luces direccionales delanteras lado izquierdo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzDireccDelantIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 186);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado izquierdo:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasDelantIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 186);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_Techo, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Piso interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_PisoInter, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Cabina y camarote:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_cabinaCamarote, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 210);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Piso interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_PisoInter, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 210);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Cabina y camarote:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_cabinaCamarote, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 222);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Área de equipaje y herramienta :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_equipHerram, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 222);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_sinPlagas, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 234);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Sin basura :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_basura, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 234);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Tanque de Diesel:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_tanqDiesel, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 246);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Tanque de aire:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_tanqAire, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 246);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Quinta rueda:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_quintaRueda, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 258);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Chasis y piso exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 258);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado izquierdo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq, 'L,R', 2, '');


    $CI->F_pdf->AddPage();

    $CI->F_pdf->SetXY(15, 10);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LuzTrasIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 10);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz direccional trasera lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzDirTrasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 22);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzTrasDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 22);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasTraserasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 34);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Escape:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_escape, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 34);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Motor:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_motor, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasDelantDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode(""), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, " ", 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 58);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios del tractocamión:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($comentarios_tracto), 'L,R,B', 2, '');
    /* Semirremolques */
    $CI->F_pdf->SetXY(10, 69);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Perno rey y palanca:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_pernoRey, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared lateral externa lado izquierdo"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($SR_paredLatExt), 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 90);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Chasis y piso exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 90);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado izquierdo"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Puertas parte exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_puertaPartExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Puertas parte interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_puertaInt, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 114);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Bisagras:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 114);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Mecanismo de cierre:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Defensa:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_defensa, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado izquierdo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasExtIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 138);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado derecho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasExtDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 138);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior lateral:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntLateral, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 150);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior frontal:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntFrontal, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 150);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Piso interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_pisoInt, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 162);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_techoInt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 162);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin olores:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_olores, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_plagas, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Exceso de tierra y lodo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_excesoTierraLodo, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 186);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin basura"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_basura, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 186);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida largo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medLargo . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida ancho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,B', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAncho . " ft", 'L,B', 2, '');
    }

    $CI->F_pdf->SetXY(100, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida alto:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAlto . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 210);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sellos VVTT:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_selloVVTT, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 210);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de sellos:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $sellosSemi, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 222);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de placas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_numPlacas, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 222);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Nombre del estado de la placa:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_estadoPlaca, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 234);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado derecho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 234);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 246);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_techoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 246);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared lateral exterior lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredLatExtDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 258);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared exterior frontal:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredExtFrontal, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 258);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Unidad refrigerada:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_unidadRefrig, 'L,R', 2, '');

    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(15, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios del tractocamión:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($comentarios_inspeccion), 'L,R,B', 2, '');
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

    $CI->F_pdf->SetXY(10, 26);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Marcas de llantas"), 0, 1, 'C');

    $CI->F_pdf->SetXY(10, 28);
    $CI->F_pdf->SetFont('Arial', '', 10);

    $CI->F_pdf->SetXY(10, 35);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 1:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[0], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 2:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[1], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 3:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[2], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 4:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[3], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 5:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[4], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 6:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[5], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 7:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[6], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 8:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[7], 'T,R', 1, '');

    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 9:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[8], 'T,R,B', 1, '');


    $CI->F_pdf->SetXY(100, 35);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 10:"), 'L', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[9], 0, 1, '');
    $CI->F_pdf->SetXY(100, 43);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 11:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[10], 0, 1, '');
    $CI->F_pdf->SetXY(100, 51);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 12:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[11], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 59);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 13:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[12], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 67);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 14:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[13], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 75);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 15:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[14], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 83);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 16:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[15], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 91);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 17:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[16], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 99);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 18:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[17], 'T,R,B', 1, '');


    $CI->F_pdf->SetXY(0, 108);
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

    $CI->F_pdf->SetXY(9, 118);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(91, 5, utf_decode("Guardia"), 'L,T,B', 2, 'C');
    $CI->F_pdf->Cell(91, 30, " ", 'L,B', 2, 'C');
    if (isset($firmaGuardia)) {
        $CI->F_pdf->Image($firmaGuardia, 25, 130, 50, 20);
    }

    $CI->F_pdf->SetXY(100, 118);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(100, 5, utf_decode("Operador"), 'L,T,R,B', 2, 'C');
    $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
    if (isset($firmaOperador)) {
        $CI->F_pdf->Image($firmaOperador, 130, 130, 50, 20);
    }

    if (isset($firmaSupervisor)) {
        $CI->F_pdf->SetXY(50, 153);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Supervisor"), 'L,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 75, 165, 50, 20);
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

function pdf_formato_inspeccionDoble($post)
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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);
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
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre guardia: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_usuario_ins, 'B,R', 1, '');
    $CI->F_pdf->SetXY(15, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre operador: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_operador, 'B,R', 1, '');
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
    $CI->F_pdf->Cell(30, 8, utf_decode("Comentarios: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $comentarios_tracto, 'T,B,R', 2, '');

    /* DATOS SEMIRREMOLQUE 1 */

    $CI->F_pdf->SetXY(10, 118);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("SEMIRREMOLQUE 1"), 0, 1, 'C');
    $CI->F_pdf->SetXY(15, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(12, 8, utf_decode("Línea: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $compania_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Marca del Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 142);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Semirremolque No Eco: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_semi, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 150);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_semi, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 158);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Tipo de Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tipo_semirremolque, 'T,B,R', 1, '');


    $CI->F_pdf->SetXY(100, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Vigencia de Licencia: "), 'L', 0, 'L');
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

    $CI->F_pdf->SetXY(100, 126);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Estatus:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $estatus_Semi1, 0, 1, '');
    $CI->F_pdf->SetXY(100, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Año semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $anio_semirremolque, 0, 1, '');
    $CI->F_pdf->SetXY(100, 142);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nº serie semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_serie_semi, 0, 1, '');
    $CI->F_pdf->SetXY(100, 150);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Temperatura semirremolque: "), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $temp_semi, 0, 1, '');

    /* DATOS SEMIRREMOLQUE 2 */

    $CI->F_pdf->SetXY(10, 166);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("SEMIRREMOLQUE 2"), 0, 1, 'C');
    $CI->F_pdf->SetXY(15, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(12, 8, utf_decode("Línea: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $compania_semirremolque2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 182);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Marca del Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_semirremolque2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 190);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Semirremolque No Eco: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_semi2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_semi2, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 206);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Tipo de Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tipo_semirremolque2, 'T,B,R', 1, '');

    $CI->F_pdf->SetXY(100, 174);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Estatus:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $estatus_Semi2, 0, 1, '');
    $CI->F_pdf->SetXY(100, 182);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Año semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $anio_semirremolque2, 0, 1, '');
    $CI->F_pdf->SetXY(100, 190);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nº serie semirremolque:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_serie_semi2, 0, 1, '');
    $CI->F_pdf->SetXY(100, 198);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Temperatura semirremolque: "), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $temp_semi2, 0, 1, '');

    /* Tractocamiones */
    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(10, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL TRACTOCAMIÓN"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 23);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Izquierdo:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_izq, 'T,B', 1, '');
    $CI->F_pdf->SetXY(73, 23);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Derecho:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_der, 'T,B', 1, '');
    $CI->F_pdf->SetXY(130, 23);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 8, utf_decode("Llantas baja presión:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $llantas_baja_presion, 'T,B,R', 1, '');


    $CI->F_pdf->SetXY(15, 31);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Defensa:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_defensa, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 31);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luces direccionales delanteras lado izquierdo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzDireccDelantIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 43);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado izquierdo:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasDelantIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 43);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_Techo, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 55);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Piso interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_PisoInter, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 55);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Cabina y camarote:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_cabinaCamarote, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 67);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Área de equipaje y herramienta :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_equipHerram, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 67);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_sinPlagas, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 79);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Sin basura :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_basura, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 79);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Tanque de Diesel:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_tanqDiesel, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 91);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Tanque de aire:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_tanqAire, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 91);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Quinta rueda:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_quintaRueda, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 103);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Chasis y piso exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 103);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado izquierdo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 115);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LuzTrasIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 115);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz direccional trasera lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzDirTrasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 127);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzTrasDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 127);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasTraserasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 139);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Escape:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_escape, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 139);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Motor:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_motor, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 151);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasDelantDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 151);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode(""), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, " ", 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 163);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios del tractocamión:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($comentarios_tracto), 'L,R,B', 2, '');
    /* Semirremolques 1 */
    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(10, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE 1"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 28);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Perno rey y palanca:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_pernoRey, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 28);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared lateral externa lado izquierdo"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($SR_paredLatExt), 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 40);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Chasis y piso exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 40);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado izquierdo"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 52);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Puertas parte exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_puertaPartExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 52);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Puertas parte interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_puertaInt, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 64);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Bisagras:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 64);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Mecanismo de cierre:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 76);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Defensa:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_defensa, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 76);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado izquierdo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasExtIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 88);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado derecho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasExtDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 88);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior lateral:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntLateral, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 100);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior frontal:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntFrontal, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 100);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Piso interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_pisoInt, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 112);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_techoInt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 112);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin olores:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_olores, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 124);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_plagas, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 124);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Exceso de tierra y lodo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_excesoTierraLodo, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 136);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin basura"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_basura, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 136);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida largo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medLargo . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 148);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida ancho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,B', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAncho . " ft", 'L,B', 2, '');
    }

    $CI->F_pdf->SetXY(100, 148);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida alto:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAlto . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 160);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sellos VVTT:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_selloVVTT, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 160);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de sellos:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $sellosSemi, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 172);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de placas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_numPlacas, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 172);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Nombre del estado de la placa:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_estadoPlaca, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 184);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado derecho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 184);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 196);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_techoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 196);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared lateral exterior lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredLatExtDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 208);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared exterior frontal:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredExtFrontal, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 208);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Unidad refrigerada:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_unidadRefrig, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 220);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios: "), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($comentarios_inspeccion), 'L,R,B', 2, '');
    /* Semirremolques 2 */
    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(10, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE 2"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 28);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Perno rey y palanca:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_pernoRey2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 28);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared lateral externa lado izquierdo"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($SR_paredLatExt2), 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 40);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Chasis y piso exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_chasisPisoExt2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 40);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado izquierdo"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 52);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Puertas parte exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_puertaPartExt2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 52);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Puertas parte interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_puertaInt2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 64);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Bisagras:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_chasisPisoExt2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 64);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Mecanismo de cierre:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasIzq2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 76);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Defensa:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_defensa2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 76);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado izquierdo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasExtIzq2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 88);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado derecho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasExtDer2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 88);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior lateral:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntLateral2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 100);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior frontal:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntFrontal2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 100);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Piso interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_pisoInt2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 112);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_techoInt2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 112);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin olores:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_olores2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 124);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_plagas2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 124);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Exceso de tierra y lodo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_excesoTierraLodo2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 136);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin basura"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_basura2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 136);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida largo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo2 == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medLargo2 . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 148);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida ancho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho2 == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,B', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAncho2 . " ft", 'L,B', 2, '');
    }

    $CI->F_pdf->SetXY(100, 148);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida alto:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto2 == "0") {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAlto2 . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 160);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sellos VVTT:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_selloVVTT2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 160);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de sellos:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $sellosSemi2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 172);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de placas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_numPlacas2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 172);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Nombre del estado de la placa:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_estadoPlaca2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 184);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luz trasera lado derecho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_luzTrasDer2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 184);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_llantasTraserasDer2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 196);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_techoExt2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 196);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared lateral exterior lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredLatExtDer2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 208);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared exterior frontal:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredExtFrontal2, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 208);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Unidad refrigerada:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_unidadRefrig2, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 220);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios: "), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($comentarios_inspeccion), 'L,R,B', 2, '');

    /* Inspeccion de llantas */

    $llantasArray = array();
    for ($i = 1; $i <= 26; $i++) {
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

    $CI->F_pdf->AddPage();

    $CI->F_pdf->SetXY(5, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Marcas de llantas"), 0, 1, 'C');

    $CI->F_pdf->SetXY(10, 17);
    $CI->F_pdf->SetFont('Arial', '', 10);

    $CI->F_pdf->SetXY(15, 24);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 1:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[0], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 32);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 2:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[1], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 40);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 3:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[2], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 48);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 4:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[3], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 56);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 5:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[4], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 64);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 6:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[5], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 72);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 7:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[6], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 80);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 8:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[7], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 88);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 9:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[8], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(15, 96);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 10:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[9], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(15, 104);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 11:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[10], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(15, 112);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 12:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[11], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(15, 120);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 13:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[12], 'T,R,B', 1, '');


    $CI->F_pdf->SetXY(100, 24);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 14:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[13], 0, 1, '');
    $CI->F_pdf->SetXY(100, 32);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 15:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[14], 0, 1, '');
    $CI->F_pdf->SetXY(100, 40);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 16:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[15], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 48);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 17:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[16], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 56);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 18:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[17], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 64);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 19:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[18], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 72);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 20:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[19], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 80);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 21:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[20], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 88);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 22:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[21], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(100, 96);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 23:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[22], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(100, 104);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 24:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[23], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(100, 112);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 25:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[24], 'T,R,B', 1, '');
    $CI->F_pdf->SetXY(100, 120);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 26:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[25], 'T,R,B', 1, '');


    $CI->F_pdf->SetXY(0, 129);
    $CI->F_pdf->SetFont('Arial', 'B', 13);
    $CI->F_pdf->Cell(0, 10, utf_decode("Firmas"), 0, 1, 'C');

    $fotosArray = array();
    foreach ($imagenes as $imagen) {
        $tipoImagen = substr($imagen->nombre_archivo, 0, 1);
        $numeroImagen = substr($imagen->nombre_archivo, 14, 2);
        $numeroSemi = substr($imagen->nombre_archivo, 16, 2);

        if ($tipoImagen == 'S') {
            if ($numeroImagen == '01') {
                $firmaGuardia = $rutaServerFolio . $imagen->nombre_archivo;
            } elseif ($numeroImagen == '02') {
                $firmaOperador = $rutaServerFolio . $imagen->nombre_archivo;
            } elseif ($numeroImagen == '03') {
                $firmaSupervisor = $rutaServerFolio . $imagen->nombre_archivo;
            }
        } elseif ($tipoImagen == 'T') {
            if ($numeroSemi == '_1') {
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
            } else {
                if ($numeroSemi == '_2') {
                    switch ($numeroImagen) {
                        case '01':
                            $trazo1_2 = $rutaServerFolio . $imagen->nombre_archivo;
                            break;
                        case '02':
                            $trazo2_2 = $rutaServerFolio . $imagen->nombre_archivo;
                            break;
                        case '03':
                            $trazo3_2 = $rutaServerFolio . $imagen->nombre_archivo;
                            break;
                        case '04':
                            $trazo4_2 = $rutaServerFolio . $imagen->nombre_archivo;
                            break;
                        case '05':
                            $trazo5_2 = $rutaServerFolio . $imagen->nombre_archivo;
                            break;
                    }
                }
            }
        } elseif ($tipoImagen == 'F') {
            array_push($fotosArray, $rutaServerFolio . $imagen->nombre_archivo);
        }
    }
    for ($i = count($fotosArray); $i <= 10; $i++) {
        array_push($fotosArray, $GLOBALS['rutaServer'] . 'blanco.png');
    }

    $CI->F_pdf->SetXY(9, 138);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(91, 5, utf_decode("Guardia"), 'L,T,B', 2, 'C');
    $CI->F_pdf->Cell(91, 30, " ", 'L,B', 2, 'C');
    if (isset($firmaGuardia)) {
        $CI->F_pdf->Image($firmaGuardia, 25, 150, 50, 20);
    }
    $CI->F_pdf->SetXY(100, 138);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(100, 5, utf_decode("Operador"), 'L,T,R,B', 2, 'C');
    $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
    if (isset($firmaOperador)) {
        $CI->F_pdf->Image($firmaOperador, 130, 150, 50, 20);
    }

    if (isset($firmaSupervisor)) {
        $CI->F_pdf->SetXY(50, 173);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Supervisor"), 'L,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 75, 185, 50, 20);
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
    if (!isset($trazo1_2)) {
        $trazo1_2 = $GLOBALS['rutaDefault'] . "caja_izquierda.png";
    }
    if (!isset($trazo3_2)) {
        $trazo3_2 = $GLOBALS['rutaDefault'] . "caja_derecha.png";
    }
    if (!isset($trazo4_2)) {
        $trazo4_2 = $GLOBALS['rutaDefault'] . "caja_arriba.png";
    }
    if (!isset($trazo2_2)) {
        $trazo2_2 = $GLOBALS['rutaDefault'] . "caja_atras.png";
    }
    if (!isset($trazo5_2)) {
        $trazo5_2 = $GLOBALS['rutaDefault'] . "caja_interior.png";
    }

    $CI->F_pdf->Image($trazo7, 35, 20, 58, 40);
    $CI->F_pdf->Image($trazo6, 116, 20, 58, 40);

    $CI->F_pdf->SetXY(0, 72);
    $CI->F_pdf->SetFont('Arial', 'B', 13);
    $CI->F_pdf->Cell(0, 10, utf_decode("Semirremolque 1"), 0, 1, 'C');
    $CI->F_pdf->Image($trazo1, 25, 82, 58, 40);
    $CI->F_pdf->Image($trazo3, 86, 82, 58, 40);
    $CI->F_pdf->Image($trazo4, 153, 82, 19, 80);
    $CI->F_pdf->Image($trazo2, 25, 118, 57, 40);
    $CI->F_pdf->Image($trazo5, 86, 118, 57, 40);

    $CI->F_pdf->SetXY(0, 170);
    $CI->F_pdf->SetFont('Arial', 'B', 13);
    $CI->F_pdf->Cell(0, 10, utf_decode("Semirremolque 2"), 0, 1, 'C');
    $CI->F_pdf->Image($trazo1_2, 25, 178, 58, 40);
    $CI->F_pdf->Image($trazo3_2, 86, 178, 58, 40);
    $CI->F_pdf->Image($trazo4_2, 153, 178, 19, 80);
    $CI->F_pdf->Image($trazo2_2, 25, 221, 57, 40);
    $CI->F_pdf->Image($trazo5_2, 86, 221, 57, 40);


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



    return $CI->F_pdf->Output("reporte_InspeccionDobleSemi.pdf", 'I', false);
}

function pdf_formato_inspeccionSin($post)
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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

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
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre guardia: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_usuario_ins, 'B,R', 1, '');
    $CI->F_pdf->SetXY(15, 46);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre operador: "), 'L,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nombre_operador, 'B,R', 1, '');
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
    $CI->F_pdf->Cell(30, 8, utf_decode("Comentarios: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $comentarios_tracto, 'T,B,R', 2, '');

    $CI->F_pdf->SetXY(100, 54);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Vigencia de Licencia: "), 'L', 0, 'L');
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

    /* Tractocamiones */

    $CI->F_pdf->SetXY(10, 120);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL TRACTOCAMIÓN"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Izquierdo:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_izq, 'T,B', 1, '');
    $CI->F_pdf->SetXY(73, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 8, utf_decode("Espejo Lateral Derecho:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $espejo_lat_der, 'T,B', 1, '');
    $CI->F_pdf->SetXY(130, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 8, utf_decode("Llantas baja presión:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $llantas_baja_presion, 'T,B,R', 1, '');

    $CI->F_pdf->SetXY(15, 136);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Defensa:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_defensa, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 136);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luces direccionales delanteras lado izquierdo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzDireccDelantIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 148);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado izquierdo:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasDelantIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 148);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_Techo, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 160);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Piso interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_PisoInter, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 160);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Cabina y camarote:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_cabinaCamarote, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 172);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Área de equipaje y herramienta :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_equipHerram, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 172);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_sinPlagas, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 184);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Sin basura :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_basura, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 184);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Tanque de Diesel:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_tanqDiesel, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 196);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Tanque de aire:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_tanqAire, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 196);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Quinta rueda:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_quintaRueda, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 208);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Chasis y piso exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 208);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado izquierdo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasTraserasIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 220);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LuzTrasIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 220);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz direccional trasera lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzDirTrasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 232);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_luzTrasDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 232);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasTraserasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 244);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Escape:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_escape, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 244);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Motor:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_motor, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 256);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $TC_LlantasDelantDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 256);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode(""), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, " ", 'L,R', 2, '');

    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(15, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios del tractocamión:"), 'L,R,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($comentarios_tracto), 'L,R,B', 2, '');



    /* Inspeccion de llantas */

    $llantasArray = array();
    for ($i = 1; $i <= 10; $i++) {
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

    $CI->F_pdf->SetXY(5, 28);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Marcas de llantas"), 0, 1, 'C');

    $CI->F_pdf->SetXY(10, 29);
    $CI->F_pdf->SetFont('Arial', '', 10);

    $CI->F_pdf->SetXY(15, 36);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 1:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[0], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 44);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 2:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[1], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 52);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 3:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[2], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 60);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 4:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[3], 'T,R', 1, '');
    $CI->F_pdf->SetXY(15, 68);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 5:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[4], 'B,T,R', 1, '');


    $CI->F_pdf->SetXY(100, 36);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 6:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[5], 0, 1, '');
    $CI->F_pdf->SetXY(100, 44);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 7:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[6], 0, 1, '');
    $CI->F_pdf->SetXY(100, 52);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 8:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[7], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 60);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 9:"), 'L,T', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[8], 'T,R', 1, '');
    $CI->F_pdf->SetXY(100, 68);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Marca 10:"), 'L,T,B', 0, 'R');
    $CI->F_pdf->SetFont('Arial', '', 10);
    $CI->F_pdf->Cell(0, 8, $llantasArray[9], 'B,T,R', 1, '');

    $CI->F_pdf->SetXY(0, 77);
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

    $CI->F_pdf->SetXY(9, 85);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(91, 5, utf_decode("Guardia"), 'L,T,B', 2, 'C');
    $CI->F_pdf->Cell(91, 30, " ", 'L,B', 2, 'C');
    if (isset($firmaGuardia)) {
        $CI->F_pdf->Image($firmaGuardia, 25, 93, 50, 20);
    }
    $CI->F_pdf->SetXY(100, 85);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(100, 5, utf_decode("Operador"), 'L,T,R,B', 2, 'C');
    $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
    if (isset($firmaOperador)) {
        $CI->F_pdf->Image($firmaOperador, 130, 93, 50, 20);
    }

    if (!isset($trazo7)) {
        $trazo7 = $GLOBALS['rutaDefault'] . "tractor_blanco_derecha.png";
    }
    if (!isset($trazo6)) {
        $trazo6 = $GLOBALS['rutaDefault'] . "tractor_blanco.png";
    }

    if (isset($firmaSupervisor)) {
        $CI->F_pdf->SetXY(50, 120);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Supervisor"), 'L,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 75, 132, 50, 20);

        $CI->F_pdf->SetXY(0, 167);
        $CI->F_pdf->SetFont('Arial', 'B', 14);
        $CI->F_pdf->Cell(0, 10, utf_decode("Trazados"), 0, 1, 'C');

        $CI->F_pdf->Image($trazo7, 15, 189, 82, 64);
        $CI->F_pdf->Image($trazo6, 105, 189, 82, 64);
    } else {
        $CI->F_pdf->SetXY(0, 130);
        $CI->F_pdf->SetFont('Arial', 'B', 14);
        $CI->F_pdf->Cell(0, 10, utf_decode("Trazados"), 0, 1, 'C');

        $CI->F_pdf->Image($trazo7, 15, 153, 82, 64);
        $CI->F_pdf->Image($trazo6, 105, 153, 82, 64);
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



    return $CI->F_pdf->Output("reporte_InspeccionSinSemi.pdf", 'I', false);
}

function pdf_busqueda($post)
{
    date_default_timezone_set('America/Matamoros');
    $fecha_actual_completa = date('Ymd');

    $CI = &get_instance();
    $CI->load->database();

    $folios = $post['Folios'];
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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

    $CI->F_pdf->SetXY(0, 13);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("RESULTADO DE BÚSQUEDA"), '0', 'C', false);
    $CI->F_pdf->SetXY(10, 25);
    $CI->F_pdf->SetFont('Arial', 'B', 9);
    $w = array(20, 15, 25, 35, 40, 50, 25, 40, 35);

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
    $CI->F_pdf->MultiCell($w[7], 12, utf_decode('Tipo inspección'), "L,T,B", 'C');
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
                $CI->F_pdf->MultiCell($w[7], 12, utf_decode('Tipo inspección'), "L,T,B", 'C');
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
            $CI->F_pdf->MultiCell($w[7], 10, $tipoInspeccion, 0, 'C');
            $CI->F_pdf->SetXY($current_x + $w[7], $current_y);
            $current_x = $CI->F_pdf->GetX();
            if ($sellos2 == "") {
                $CI->F_pdf->MultiCell($w[8], 10, $sellos1, 'L,R', 'C');
            } else {
                $CI->F_pdf->MultiCell($w[8], 5, $sellos1 . "\n" . $sellos2, 'L,R', 'C');
            }
            $current_x = $CI->F_pdf->GetX();
        }
    }

    return $CI->F_pdf->Output("reporte_" . $fecha_actual_completa . ".pdf", 'I', false);
}

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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

    $CI->F_pdf->SetXY(0, 13);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("REPORTE DE CAJAS"), '0', 'C', false);
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
        $CI->F_pdf->MultiCell($w[6], 10, $tipo_movimiento, 'L,R', 'J');
        $CI->F_pdf->SetXY($current_x + $w[6], $current_y);
        $current_x = $CI->F_pdf->GetX();
        $CI->F_pdf->MultiCell($w[7], 5 * $cliente_multi, $cliente, 'L,R', 'J');
    }

    return $CI->F_pdf->Output("reporte_" . $fecha_actual_completa . ".pdf", 'I', false);
}

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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

    $CI->F_pdf->SetXY(0, 13);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->MultiCell(0, 4, utf_decode("REPORTE DE TRACTOCAMIONES"), '0', 'C', false);
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
            $CI->F_pdf->Cell(50, 7, utf8_decode('Tractocamión'), 'L,T', 0, 'C');

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

function pdf_formato_inspeccionAlmacen($post)
{
    $CI = &get_instance();
    $CI->load->database();

    $inspeccionID = $post['inspeccionID'];
    $queryInspeccion = $CI->db->get_where('vw_inspecciones', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccion->result() as $row) {
        $folio = $row->Folio;
        $fecha_inspeccion = $row->FechaInspeccion;
        $hora_inspeccion = substr($row->HoraInspeccion, 0, 5);
        $tipo_movimiento = utf_decode($row->TipoMovimiento);
        $nombre_usuario_ins = strtoupper(utf_decode($row->nombreUsuarioInspCompleto));
        $procedencia = utf_decode(strtoupper($row->Procedencia));
        $cliente = strtoupper(utf_decode($row->Cliente));
        $proveedor = strtoupper(utf_decode($row->Proveedor));
        $cajon = strtoupper(utf_decode($row->cajon));
        $sellosSemi = strtoupper(utf_decode($row->sellosSemi));
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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

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
        $CI->F_pdf->SetXY(75, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("HORA: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $hora_inspeccion, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(130, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(20, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    } else {
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
        $CI->F_pdf->Cell(20, 8, utf_decode("CAJÓN: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $cajon, 'T,B,R', 1, '');
        $CI->F_pdf->SetXY(135, 28);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(15, 8, utf_decode("TIPO: "), 'L,T,B', 0, 'R');
        $CI->F_pdf->SetFont('Arial', '', 10);
        $CI->F_pdf->Cell(0, 8, $tipo_movimiento, 'T,B,R', 1, '');
    }

    $CI->F_pdf->SetXY(15, 36);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 8, utf_decode("Nombre guardia: "), 'L,T,B', 0, 'L');
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
    $CI->F_pdf->SetXY(15, 67);
    $CI->F_pdf->SetFont('Arial', 'B', 10);

    $CI->F_pdf->SetXY(10, 60);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE"), 0, 1, 'C');


    $CI->F_pdf->SetXY(15, 68);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Puertas parte interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_puertaInt, 'L,R,B', 2, '');

    $CI->F_pdf->SetXY(100, 68);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior lateral:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntLateral, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 80);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Pared interior frontal:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_paredIntFrontal, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 80);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Piso interior:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_pisoInt, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 92);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_techoInt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 92);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin olores:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_olores, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 104);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_plagas, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 104);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Exceso de tierra y lodo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_excesoTierraLodo, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 116);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin basura"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_basura, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 116);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida largo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == 0) {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medLargo . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida ancho:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == 0) {
        $CI->F_pdf->Cell(0, 7, "", 'L,B', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAncho . " ft", 'L,B', 2, '');
    }

    $CI->F_pdf->SetXY(100, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Medida alto:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == 0) {
        $CI->F_pdf->Cell(0, 7, "", 'L,R', 2, '');
    } else {
        $CI->F_pdf->Cell(0, 7, $SR_medAlto . " ft", 'L,R', 2, '');
    }

    $CI->F_pdf->SetXY(15, 140);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sellos VVTT:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_selloVVTT, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 140);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de sellos:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $sellosSemi, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 152);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Número de placas:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_numPlacas, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 152);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Nombre del estado de la placa:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, $SR_estadoPlaca, 'L,R', 2, '');


    $CI->F_pdf->SetXY(15, 164);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 7, utf_decode($comentarios_inspeccion), 'L,R,B', 2, '');


    $CI->F_pdf->SetXY(0, 175);
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
        $CI->F_pdf->SetXY(9, 183);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(91, 5, utf_decode("Guardia inspección"), 'L,T,B', 2, 'C');
        $CI->F_pdf->Cell(91, 30, " ", 'L,B', 2, 'C');
        $CI->F_pdf->Image($firmaGuardia, 35, 190, 50, 20);

        $CI->F_pdf->SetXY(100, 183);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Supervisor"), 'T,L,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 30, " ", 'L,B,R', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 125, 190, 50, 20);
    } else {
        $CI->F_pdf->SetXY(56, 183);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(91, 5, utf_decode("Guardia inspección"), 'L,T,B,R', 2, 'C');
        $CI->F_pdf->Cell(91, 30, " ", 'L,B,R', 2, 'C');
        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 65, 190, 50, 20);
        }
    }


    $CI->F_pdf->SetXY(0, 217);
    $CI->F_pdf->SetFont('Arial', 'B', 14);
    $CI->F_pdf->Cell(0, 10, utf_decode("Trazado"), 0, 1, 'C');

    if (isset($trazo1)) {
        $CI->F_pdf->Image($trazo1, 71, 226, 58, 40);
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

function pdf_formato_inspeccion_usu_insp($post)
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
        $compania_semirremolque = strtoupper(utf_decode($row->CompaniaSemirremolque));
        $marca_semirremolque = strtoupper($row->MarcaSemirremolque);
        $anio_semirremolque = $row->AnioSemirremolque;
        $num_serie_semi = strtoupper(utf_decode($row->NumSerieSemi));
        $num_econ_semi = strtoupper($row->NumEconSemi);
        $tipo_semirremolque = strtoupper($row->TipoSemirremolque);
        $temp_semi = utf_decode($row->TemperaturaSemi);
        $nivel_combust_semi = utf_decode($row->NivelCombustSemi);
        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));
        $sellosSemi = strtoupper(utf_decode($row->sellosSemi));
        $sellosSemi2 = strtoupper(utf_decode($row->sellosSemi2));
        $cajon = strtoupper(utf_decode($row->cajon));
        $estatus_Semi1 = strtoupper(utf_decode($row->estatusSemi));

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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

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
    $CI->F_pdf->Cell(38, 8, utf_decode("Línea Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $compania_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(100, 78);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(46, 8, utf_decode("Marca del Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $marca_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(41, 8, utf_decode("Semirremolque No Eco: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $num_econ_semi, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 94);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(42, 8, utf_decode("Tipo de Semirremolque: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $tipo_semirremolque, 'T,B,R', 1, '');
    $CI->F_pdf->SetXY(15, 206);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(25, 16, utf_decode("Comentarios:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 16, $comentarios_tracto, 'T,B,R', 2, '');

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
    $CI->F_pdf->SetXY(100, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 8, utf_decode("Nivel de combustible: "), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $nivel_combust_tracto, 'T,B,R', 1, '');

    $CI->F_pdf->SetXY(100, 94);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(20, 8, utf_decode("Estatus:"), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $estatus_Semi1, 0, 1, '');
    $CI->F_pdf->SetXY(150, 86);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(30, 8, utf_decode("Temperatura: "), 'L', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 8, $temp_semi, 0, 1, '');

    /* Semirremolques */
    $CI->F_pdf->SetXY(10, 102);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL SEMIRREMOLQUE"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 110);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Perno rey y palanca:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_pernoRey, 'B,T', 0, '');

    $CI->F_pdf->SetXY(100, 110);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral externa lado izquierdo"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, utf_decode($SR_paredLatExt), "B,R,T", 0, 'L');

    $CI->F_pdf->SetXY(15, 116);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Chasis y piso exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 116);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq, 'R', 0, 'L');

    $CI->F_pdf->SetXY(15, 122);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Puertas parte exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_puertaPartExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 122);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Puertas parte interior:"), 'L,,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_puertaInt, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Bisagras:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_chasisPisoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 128);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Mecanismo de cierre:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasIzq, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Defensa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_defensa, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 134);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_luzTrasExtIzq, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 140);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasExtDer, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 140);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared interior lateral:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredIntLateral, 'B,R', 0, '');


    $CI->F_pdf->SetXY(15, 146);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared interior frontal:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredIntFrontal, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 146);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Piso interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_pisoInt, 'R', 0, '');

    $CI->F_pdf->SetXY(15, 152);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo interior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoInt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 152);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Sin olores:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_olores, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 158);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin plagas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_plagas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 158);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Exceso de tierra y lodo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_excesoTierraLodo, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 164);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sin basura"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_basura, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 164);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida largo:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medLargo == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medLargo . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 170);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Medida ancho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAncho == "0") {
        $CI->F_pdf->Cell(0, 6, "", 'B', 0, '');
    } else {
        $CI->F_pdf->Cell(0, 6, $SR_medAncho . " ft", 'B', 0, '');
    }

    $CI->F_pdf->SetXY(100, 170);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Medida alto:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    if ($SR_medAlto == "0") {
        $CI->F_pdf->Cell(30, 6, "", 'B,R', 0, '');
    } else {
        $CI->F_pdf->Cell(30, 6, $SR_medAlto . " ft", 'B,R', 0, '');
    }

    $CI->F_pdf->SetXY(15, 176);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Sellos VVTT:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_selloVVTT, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 176);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Número de sellos:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $sellosSemi, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 182);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Número de placas:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_numPlacas, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 182);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 6, utf_decode("Estado de la placa:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(60, 6, $SR_estadoPlaca, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 188);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Luz trasera lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_luzTrasDer, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 188);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Llantas traseras lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_llantasTraserasDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 194);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Techo exterior:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_techoExt, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 194);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Pared lateral exterior lado derecho:"), 'L,T', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_paredLatExtDer, 'B,R', 0, '');

    $CI->F_pdf->SetXY(15, 200);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(50, 6, utf_decode("Pared exterior frontal:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $SR_paredExtFrontal, 'B', 0, '');

    $CI->F_pdf->SetXY(100, 200);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(70, 6, utf_decode("Unidad refrigerada:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(30, 6, $SR_unidadRefrig, 'B,R', 0, '');


    /* Firmas */

    $CI->F_pdf->SetXY(0, 220);
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

        $CI->F_pdf->SetXY(15, 246);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(40, 5, utf_decode("Guardia"), 'T,B,L', 2, 'C');

        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 15, 236, 35, 10);
        }

        $CI->F_pdf->SetXY(30, 246);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(140, 5, utf_decode("Operador"), 'T,B', 2, 'C');
        if (isset($firmaOperador)) {
            $CI->F_pdf->Image($firmaOperador, 83, 236, 35, 10);
        }

        $CI->F_pdf->SetXY(140, 246);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(0, 5, utf_decode("Supervisor"), 'T,R,B', 2, 'C');
        $CI->F_pdf->Image($firmaSupervisor, 150, 236, 35, 10);
    } else {
        $CI->F_pdf->SetXY(15, 228);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(91, 5, utf_decode("Guardia"), 'L,T,B', 2, 'C');
        $CI->F_pdf->Cell(91, 20, " ", 'L,B', 2, 'C');
        if (isset($firmaGuardia)) {
            $CI->F_pdf->Image($firmaGuardia, 40, 236, 35, 10);
        }

        $CI->F_pdf->SetXY(100, 228);
        $CI->F_pdf->SetFont('Arial', 'B', 12);
        $CI->F_pdf->Cell(100, 5, utf_decode("Operador"), 'L,T,R,B', 2, 'C');
        $CI->F_pdf->Cell(100, 20, " ", 'L,B,R', 2, 'C');
        if (isset($firmaOperador)) {
            $CI->F_pdf->Image($firmaOperador, 130, 236, 35, 10);
        }
    }

    return $CI->F_pdf->Output("reporte_Inspeccion.pdf", 'I', false);
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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);
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

    $CI->F_pdf->Image($GLOBALS['rutaLogos'] . $empresa_id . ".png", 16, 8, -500);

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

function pdf_formato_inspeccion_ticketDoble($post)
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
        $proveedor = strtoupper(utf_decode($row->Proveedor));
        $num_econ_tracto = strtoupper($row->NumEconomicoTracto);
        $num_placas_tracto = strtoupper($row->NumPlacasTracto);
        $compania_semirremolque = strtoupper($row->CompaniaSemirremolque);
        $marca_semirremolque = strtoupper($row->MarcaSemirremolque);
        $num_econ_semi = strtoupper($row->NumEconSemi);
        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));
        $sellosSemi = strtoupper(utf_decode($row->sellosSemi));
        $compania_semirremolque2 = strtoupper($row->CompaniaSemirremolque2);
        $marca_semirremolque2 = strtoupper($row->MarcaSemirremolque2);
        $num_econ_semi2 = strtoupper($row->NumEconSemi2);
        $sellosSemi2 = strtoupper(utf_decode($row->sellosSemi2));
        $comentarios_inspeccion = strtoupper(utf_decode($row->ComentariosInspeccion));
        $cajon = strtoupper(utf_decode($row->cajon));
        $estatus_Semi1 = strtoupper(utf_decode($row->estatusSemi));
        $estatus_Semi2 = strtoupper(utf_decode($row->estatusSemi2));
        $sr_placa_1 = $row->sr_placa_1;
        $sr_placa_edo_1 = $row->sr_placa_edo_1;
        $sr_placa_2 = $row->sr_placa_2;
        $sr_placa_edo_2 = $row->sr_placa_estado_2;
    }
    $queryInspeccionDetalles = $CI->db->get_where('inspecciones_detalles', array('InspeccionID' => $inspeccionID));

    foreach ($queryInspeccionDetalles->result() as $row) {
        if ($row->numSemi == 1) {
            $comentarios_tracto = $row->comentariosTracto;
            $comentInsp = $row->comentInsp;
        }
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
    $CI->F_pdf->Cell(5, $textypos, '------------------------- SEMIRREMOLQUE 1 -------------------------');

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

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, '------------------------- SEMIRREMOLQUE 2 -------------------------');

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('LÍNEA: ' . $compania_semirremolque2));

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'PLACAS: ' . $sr_placa_2);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, utf_decode('N° ECONÓMICO: ') . $num_econ_semi2);

    $textypos += 7;
    $CI->F_pdf->setX(2);
    $CI->F_pdf->Cell(5, $textypos, 'SELLOS: ' . $sellosSemi2);

    $CI->F_pdf->output();
}

function pdf_formato_inspeccion_ticketSin($post)
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

    $CI->F_pdf->output();
}
