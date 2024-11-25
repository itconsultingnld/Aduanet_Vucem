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

function pdf_formato_inspeccionSin($post)
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
        $tiempo_inspeccion = $row->tiempo_inspeccion;
        $tipo_movimiento = utf_decode($row->TipoMovimiento);
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
        $cajon = strtoupper(utf_decode($row->cajon));

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

    $aumento_y = 3;
    $aumento_y_tabla = 0;
    $aumento = 0;
    if ($es_transportista == 3) {
        $aumento_y_tabla = 5;
        $aumento_y = 8;
        $aumento = 12;

        $CI->F_pdf->SetXY(150, 54);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(30, 8, utf_decode("No. Gafete: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetXY(170, 54);
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $num_gafete, 'T,B,R', 2, '');

        $CI->F_pdf->SetXY(15, 118);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(30, 8, utf_decode("No. GPS: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetXY(31, 118);
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $num_gps, 'T,B,R', 2, '');

        $CI->F_pdf->SetXY(15, 126);
        $CI->F_pdf->SetFont('Arial', 'B', 10);
        $CI->F_pdf->Cell(42, 8, utf_decode("Autoriza por monitoreo: "), 'L,T,B', 0, 'L');
        $CI->F_pdf->SetXY(56, 126);
        $CI->F_pdf->SetFont('Arial', '', 8);
        $CI->F_pdf->Cell(0, 8, $autoriza, 'T,B,R', 2, '');
    }

    /* Tractocamiones */

    $CI->F_pdf->SetXY(10, 126+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 12);
    $CI->F_pdf->Cell(0, 10, utf_decode("CONDICIONES DEL TRACTOCAMIÓN"), 0, 1, 'C');

    $CI->F_pdf->SetXY(15, 134+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 6, utf_decode("Espejo Lateral Izquierdo:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $espejo_lat_izq, 'T,B', 1, '');
    $CI->F_pdf->SetXY(73, 134+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 6, utf_decode("Espejo Lateral Derecho:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $espejo_lat_der, 'T,B', 1, '');
    $CI->F_pdf->SetXY(130, 134+$aumento_y);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(40, 6, utf_decode("Llantas baja presión:"), 'L,T,B', 0, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 6, $llantas_baja_presion, 'T,B,R', 1, '');

    $CI->F_pdf->SetXY(15, 143+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Defensa:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_defensa, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 143+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Luces direccionales delanteras lado izquierdo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_luzDireccDelantIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 153+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado izquierdo:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_LlantasDelantIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 153+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Techo:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_Techo, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 163+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Piso interior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_PisoInter, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 163+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Cabina y camarote:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_cabinaCamarote, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 173+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Área de equipaje y herramienta :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_equipHerram, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 173+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Sin plagas:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_sinPlagas, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 183+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Sin basura :"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_basura, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 183+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Tanque de Diesel:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_tanqDiesel, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 193+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Tanque de aire:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_tanqAire, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 193+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Quinta rueda:"), 'L,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_quintaRueda, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 203+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Chasis y piso exterior:"), 'L', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_chasisPisoExt, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 203+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado izquierdo:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_LlantasTraserasIzq, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 213+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado izquierdo:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_LuzTrasIzq, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 213+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz direccional trasera lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_luzDirTrasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 223+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(100, 5, utf_decode("Luz trasera lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_luzTrasDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 223+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Llantas traseras lado derecho:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_LlantasTraserasDer, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 233+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Escape:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_escape, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 233+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Motor:"), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_motor, 'L,R', 2, '');

    $CI->F_pdf->SetXY(15, 243+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(45, 5, utf_decode("Llantas delanteras lado derecho:"), 'L,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, $TC_LlantasDelantDer, 'L,B', 2, '');

    $CI->F_pdf->SetXY(100, 243+$aumento_y_tabla);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode(""), 'L,T,R', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, " ", 'L,R', 2, '');

    $CI->F_pdf->AddPage();
    $CI->F_pdf->SetXY(15, 15);
    $CI->F_pdf->SetFont('Arial', 'B', 10);
    $CI->F_pdf->Cell(0, 5, utf_decode("Comentarios del tractocamión:"), 'L,R,T', 2, 'L');
    $CI->F_pdf->SetFont('Arial', '', 8);
    $CI->F_pdf->Cell(0, 5, utf_decode($comentarios_tracto), 'L,R,B', 2, '');



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
