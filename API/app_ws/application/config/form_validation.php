<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

    /* Inspecciones */

    'InsertarInspeccionCompleta_post' => array(
        array('field' => 'folio', 'label' => 'folio', 'rules' => 'trim|required'),
        array('field' => 'tipoInspeccionID', 'label' => 'tipo de inspección', 'rules' => 'trim|required|integer'),
        array('field' => 'fechaInspeccion', 'label' => 'fecha de inspección', 'rules' => 'trim|required'),
        array('field' => 'horaInspeccion', 'label' => 'hora de inspección', 'rules' => 'trim|required'),
        array('field' => 'fecha_final', 'label' => 'fecha de finalización', 'rules' => 'trim|required'),
        array('field' => 'hora_final', 'label' => 'hora de finalización', 'rules' => 'trim|required'),
        array('field' => 'TipoMovimientoID', 'label' => 'tipo de movimiento', 'rules' => 'trim|required|integer'),
        array('field' => 'usuarioInspID', 'label' => 'guardia', 'rules' => 'trim|required|integer'),
        array('field' => 'OperadorID', 'label' => 'operador', 'rules' => 'trim|required|integer'),
        array('field' => 'procedencia', 'label' => 'procedencia/destino', 'rules' => 'trim|required'),
        array('field' => 'ClienteID', 'label' => 'cliente', 'rules' => 'trim|required|integer'),
        array('field' => 'ProveedorID', 'label' => 'línea transportista', 'rules' => 'trim|required|integer'),
        array('field' => 'tractocamionID', 'label' => 'tractocamión', 'rules' => 'trim|required|integer'),
        array('field' => 'nivelFuelTC', 'label' => 'nivel de combustible del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'SemirremolqueID', 'label' => 'semirremolque 1', 'rules' => 'trim|required|integer'),
        array('field' => 'tempSemi', 'label' => 'temperatura del semirremolque 1', 'rules' => 'trim|required'),
        array('field' => 'nivelFuelSR', 'label' => 'nivel de combustible del semirremolque 1', 'rules' => 'trim|required'),
        array('field' => 'sellosSemi', 'label' => 'sellos del semirremolque 1', 'rules' => 'trim|required'),
        array('field' => 'estatusSemi', 'label' => 'estatus del semirremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SemirremolqueID2', 'label' => 'semirremolque 2', 'rules' => 'trim|required|integer'),
        array('field' => 'tempSemi2', 'label' => 'temperatura del semirremolque 2', 'rules' => 'trim|required'),
        array('field' => 'nivelFuelSR2', 'label' => 'nivel de combustible del semirremolque 2', 'rules' => 'trim|required'),
        array('field' => 'sellosSemi2', 'label' => 'sellos del semirremolque 2', 'rules' => 'trim|required'),
        array('field' => 'estatusSemi2', 'label' => 'estatus del semirremolque 2', 'rules' => 'trim|required'),
        array('field' => 'comentariosInspeccion', 'label' => 'comentarios de inspección', 'rules' => 'trim|required'),
        array('field' => 'cajon', 'label' => 'cajón', 'rules' => 'trim|required'),
        array('field' => 'num_gps', 'label' => 'número de GPS', 'rules' => 'trim|required'),
        array('field' => 'autoriza_por_monitoreo', 'label' => 'autoriza por monitoreo', 'rules' => 'trim|required'),
        array('field' => 'danio_grave', 'label' => 'daño grave', 'rules' => 'trim|required|integer'),
        array('field' => 'danio_grave_notas', 'label' => 'notas del daño grave', 'rules' => 'trim|required'),
        array('field' => 'empresa_id', 'label' => 'empresa', 'rules' => 'trim|required|integer'),
        array('field' => 'consecFolio', 'label' => 'consecutivo de folio', 'rules' => 'trim|required|integer'),
        array('field' => 'espejoLatIzq', 'label' => 'espejo lateral izquierdo', 'rules' => 'trim|required'),
        array('field' => 'espejoLatDer', 'label' => 'espejo lateral derecho', 'rules' => 'trim|required'),
        array('field' => 'llantasBajaPresion', 'label' => 'baja presión de llantas', 'rules' => 'trim|required|integer'),
        array('field' => 'comentariosTracto', 'label' => 'comentarios de tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_defensa', 'label' => 'defensa del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_luzDireccDelantIzq', 'label' => 'luz direccional delantera izquierda del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_LlantasDelantIzq', 'label' => 'llantas delanteras izquierda del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_Techo', 'label' => 'techo del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_PisoInter', 'label' => 'piso interior del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_cabinaCamarote', 'label' => 'cabina y camarote del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_equipHerram', 'label' => 'equipo y herramienta del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_sinPlagas', 'label' => 'sin plagas en tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_basura', 'label' => 'basura en tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_tanqDiesel', 'label' => 'tanque de diesel del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_tanqAire', 'label' => 'tanque de aire del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_quintaRueda', 'label' => 'quinta rueda del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_chasisPisoExt', 'label' => 'chasis y piso exterior del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_LlantasTraserasIzq', 'label' => 'llantas traseras izquierdas del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_LuzTrasIzq', 'label' => 'luz trasera izquierda del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'SR_pernoRey', 'label' => 'perno rey del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_paredLatExt', 'label' => 'pared lateral exterior del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_chasisPisoExt', 'label' => 'chasis y piso exterior del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_llantasTraserasIzq', 'label' => 'llantas traseras izquierda del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_puertaPartExt', 'label' => 'puerta parte exterior del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_puertasInt', 'label' => 'puertas interiores del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_bisagras', 'label' => 'bisagras del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_mecanCierre', 'label' => 'mecanimso de cierre del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_defensa', 'label' => 'defensa del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_luzTrasExtIzq', 'label' => 'luz trasera exterior izquierda del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_luzTrasExtDer', 'label' => 'luz trasera exterior derecha del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_paredIntLateral', 'label' => 'pared interna lateral del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_paredIntFrontal', 'label' => 'pared interna frontal del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_pisoInt', 'label' => 'piso interior del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_techoInt', 'label' => 'techo interior del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_olores', 'label' => 'olores del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_plagas', 'label' => 'plagas del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_excesoTierraLodo', 'label' => 'exceso de tierra y lodo del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_basura', 'label' => 'basura del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_medLargo', 'label' => 'medida de largo del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_medAncho', 'label' => 'medida de ancho del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_medAlto', 'label' => 'medida de alto del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_puertaInt', 'label' => 'puerta interior del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_selloVVTT', 'label' => 'sello VVTT del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_numPlacas', 'label' => 'número de placas del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_estadoPlaca', 'label' => 'estado de placa del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_luzTrasDer', 'label' => 'luz trasera derecha del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_llantasTraserasDer', 'label' => 'llantas traseras derechas del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_techoExt', 'label' => 'techo exterior del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_paredLatExtDer', 'label' => 'pared lateral exterior derecha del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'SR_paredExtFrontal', 'label' => 'pared exterior frontal del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'TC_luzDirTrasDer', 'label' => 'luz direccional trasera derecha del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'SR_unidadRefrig', 'label' => 'unidad refrigerada del semiorremolque 1', 'rules' => 'trim|required'),
        array('field' => 'TC_luzTrasDer', 'label' => 'luz trasera derecha del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_LlantasTraserasDer', 'label' => 'llantas traseras derecha del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_escape', 'label' => 'escape del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_motor', 'label' => 'motor del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_luzDireccDelantDer', 'label' => 'luz direccional delantera derecha del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'TC_LlantasDelantDer', 'label' => 'llantas delanteras derechas del tractocamión', 'rules' => 'trim|required'),
        array('field' => 'comentInsp', 'label' => 'comentarios de la inspección', 'rules' => 'trim|required'),
        array('field' => 'numSemi', 'label' => 'número de semirremolque', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta1', 'label' => 'marca de llanta 1', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta2', 'label' => 'marca de llanta 2', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta3', 'label' => 'marca de llanta 3', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta4', 'label' => 'marca de llanta 4', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta5', 'label' => 'marca de llanta 5', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta6', 'label' => 'marca de llanta 6', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta7', 'label' => 'marca de llanta 7', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta8', 'label' => 'marca de llanta 8', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta9', 'label' => 'marca de llanta 9', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta10', 'label' => 'marca de llanta 10', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta11', 'label' => 'marca de llanta 11', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta12', 'label' => 'marca de llanta 12', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta13', 'label' => 'marca de llanta 13', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta14', 'label' => 'marca de llanta 14', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta15', 'label' => 'marca de llanta 15', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta16', 'label' => 'marca de llanta 16', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta17', 'label' => 'marca de llanta 17', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta18', 'label' => 'marca de llanta 18', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta19', 'label' => 'marca de llanta 19', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta20', 'label' => 'marca de llanta 20', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta21', 'label' => 'marca de llanta 21', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta22', 'label' => 'marca de llanta 22', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta23', 'label' => 'marca de llanta 23', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta24', 'label' => 'marca de llanta 24', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta25', 'label' => 'marca de llanta 25', 'rules' => 'trim|required|integer'),
        array('field' => 'llanta26', 'label' => 'marca de llanta 26', 'rules' => 'trim|required|integer'),
    ),

    /* Dispositivos */

    'dispositivo_post' => array(
        array('field' => 'numeroserie', 'label' => 'ID del dispositivo', 'rules' => 'trim|required'),
        array('field' => 'idusuario', 'label' => 'idusuario', 'rules' => 'trim|required|integer'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer')
    ),

    /* LineasTransportistas */

    /* En la app, se valida sólo empresaProveedor, y sólo en modo Pro */
    'InsertarProveedor_post' => array(
        /* array('field' => 'empresaProveedor', 'label' => 'nombre de la línea transportista', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'calleProveedor', 'label' => 'calle', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'coloniaProveedor', 'label' => 'colonia', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'codPostalProv', 'label' => 'código postal', 'rules' => 'trim|required|min_length[5]'),
        array('field' => 'ciudadProveedor', 'label' => 'ciudad', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'estadoProveedor', 'label' => 'estado', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'contactoProveedor', 'label' => 'contacto', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'correoProveedor', 'label' => 'correo electrónico', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'numTelProveedor', 'label' => 'número telefónico de contacto', 'rules' => 'trim|required'),
        array('field' => 'puestoProveedor', 'label' => 'puesto', 'rules' => 'trim|required|min_length[2]'), */
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarProveedor_put' => array(
        array('field' => 'empresaProveedor', 'label' => 'nombre de la línea transportista', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'calleProveedor', 'label' => 'calle', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'coloniaProveedor', 'label' => 'colonia', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'codPostalProv', 'label' => 'código postal', 'rules' => 'trim|required|min_length[5]'),
        array('field' => 'ciudadProveedor', 'label' => 'ciudad', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'estadoProveedor', 'label' => 'estado', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'contactoProveedor', 'label' => 'contacto', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'correoProveedor', 'label' => 'correo electrónico', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'numTelProveedor', 'label' => 'número telefónico de contacto', 'rules' => 'trim|required'),
        array('field' => 'puestoProveedor', 'label' => 'puesto', 'rules' => 'trim|required|min_length[2]'),
    ),

    /* LineasSemirremolques */

    'insertarCompaniasSemi_post' => array(
        array('field' => 'nombreCompania', 'label' => 'nombre de la línea de semirremolque', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarCompaniaSemi_put' => array(
        array('field' => 'nombreCompania', 'label' => 'nombre de la línea de semirremolque', 'rules' => 'trim|required|min_length[2]'),
    ),

    /* TiposSemirremolques */

    'InsertarTipoSemi_post' => array(
        array('field' => 'nombreTipoSemi', 'label' => 'nombre del tipo de semirremolque', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarTipoSemirremolque_put' => array(
        array('field' => 'nombreTipoSemi', 'label' => 'nombre del tipo de semirremolque', 'rules' => 'trim|required|min_length[2]'),
    ),

    /* Semirremolques */

    /* En la app, se valida sólo numEconSemi y companiaSemiID, y sólo en modo Pro */
    'InsertarSemi_post' => array(
        /* array('field' => 'tipoSemirremolqueID', 'label' => 'tipo de semirremolque', 'rules' => 'trim|required|integer'),
        array('field' => 'marcaSR_ID', 'label' => 'marca de semirremolque', 'rules' => 'trim|required|integer'),
        array('field' => 'modeloSemi', 'label' => 'modelo', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'anioSemi', 'label' => 'año', 'rules' => 'trim|required|integer'),
        array('field' => 'numEconSemi', 'label' => 'número económico', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numSerieSemi', 'label' => 'número de serie', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'colorSemi', 'label' => 'color', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'companiaSemiID', 'label' => 'compañia del semirremolque', 'rules' => 'trim|required|integer'), */
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarSemirremolque_put' => array(
        array('field' => 'tipoSemirremolqueID', 'label' => 'tipo de semirremolque', 'rules' => 'trim|required|integer'),
        array('field' => 'marcaSR_ID', 'label' => 'marca de semirremolque', 'rules' => 'trim|required|integer'),
        array('field' => 'modeloSemi', 'label' => 'modelo', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'anioSemi', 'label' => 'año', 'rules' => 'trim|required|integer'),
        array('field' => 'numEconSemi', 'label' => 'número económico', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numSerieSemi', 'label' => 'número de serie', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'colorSemi', 'label' => 'color', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'companiaSemiID', 'label' => 'compañia del semirremolque', 'rules' => 'trim|required|integer'),
    ),

    'semirremolque_cambiar_en_patio_put' => array(
        array('field' => 'semirremolqueID', 'label' => 'semirremolque', 'rules' => 'trim|required|integer'),
        array('field' => 'idusuario', 'label' => 'usuario', 'rules' => 'trim|required|integer'),
        array('field' => 'comentario', 'label' => 'comentario', 'rules' => 'trim|required'),
    ),

    /* Tractocamiones */

    /* En la app, se valida sólo numEconTracto y numPlacas, y sólo en modo Pro */
    'InsertarTracto_post' => array(
        /* array('field' => 'MarcaTC_ID', 'label' => 'marca de tractocamión', 'rules' => 'trim|required|integer'),
        array('field' => 'modeloTracto', 'label' => 'modelo', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'anioTracto', 'label' => 'año', 'rules' => 'trim|required|integer'),
        array('field' => 'numEconTracto', 'label' => 'número económico', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numSerieTracto', 'label' => 'número de serie', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'colorTracto', 'label' => 'color', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numPlacas', 'label' => 'número de placas', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'tarjetaCirc', 'label' => 'tarjeta de circulación', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'OperadorID', 'label' => 'operador', 'rules' => 'trim|required|integer'), */
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarTractocamion_put' => array(
        array('field' => 'MarcaTC_ID', 'label' => 'marca de tractocamión', 'rules' => 'trim|required|integer'),
        array('field' => 'modeloTracto', 'label' => 'modelo', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'anioTracto', 'label' => 'año', 'rules' => 'trim|required|integer'),
        array('field' => 'numEconTracto', 'label' => 'número económico', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numSerieTracto', 'label' => 'número de serie', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'colorTracto', 'label' => 'color', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numPlacas', 'label' => 'número de placas', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'tarjetaCirc', 'label' => 'tarjeta de circulación', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'OperadorID', 'label' => 'operador', 'rules' => 'trim|required|integer'),
    ),

    'tractocamion_cambiar_en_patio_put' => array(
        array('field' => 'tractocamionID', 'label' => 'tractocamión', 'rules' => 'trim|required|integer'),
        array('field' => 'idusuario', 'label' => 'usuario', 'rules' => 'trim|required|integer'),
        array('field' => 'comentario', 'label' => 'comentario', 'rules' => 'trim|required'),
    ),

    /* MarcasSemirremolques */

    'InsertarMarcaSR_post' => array(
        array('field' => 'Nombre', 'label' => 'nombre de la marca de semirremolque', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarMarcaSR_put' => array(
        array('field' => 'Nombre', 'label' => 'nombre de la marca de semirremolque', 'rules' => 'trim|required|min_length[2]'),
    ),

    /* Coordinadores */

    'InsertarUsuario_post' => array(
        array('field' => 'nombre', 'label' => 'nombre del coordinador', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePat', 'label' => 'apellido paterno del coordinador', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMat', 'label' => 'apellido materno del coordinador', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'correo', 'label' => 'correo del coordinador', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'username', 'label' => 'nombre de usuario del coordinador', 'rules' => 'trim|required|min_length[4]'),
        array('field' => 'password', 'label' => 'password del coordinador', 'rules' => 'trim|required|min_length[6]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizausuario_put' => array(
        array('field' => 'nombre', 'label' => 'nombre', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePat', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMat', 'label' => 'apellido materno ', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'correo', 'label' => 'correo', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'username', 'label' => 'nombre de usuario', 'rules' => 'trim|required|min_length[4]'),
    ),

    /* Clientes */

    /* En la app, se valida sólo empresaCliente */
    'InsertarClientes_post' => array(
        array('field' => 'empresaCliente', 'label' => 'nombre de la empresa cliente', 'rules' => 'trim|required|min_length[3]'),
        /* array('field' => 'nombreCliente', 'label' => 'nombre del cliente', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePatCliente', 'label' => 'apellido paterno del cliente', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMatCliente', 'label' => 'apellido materno del cliente', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'puestoCliente', 'label' => 'puesto del cliente', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'correoCliente', 'label' => 'correo de contacto del cliente', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'numTelCliente', 'label' => 'numero telefonico del cliente', 'rules' => 'trim|required|min_length[15]'), */
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarClientes_put' => array(
        array('field' => 'empresaCliente', 'label' => 'nombre de la empresa cliente', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'nombreCliente', 'label' => 'nombre del cliente', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePatCliente', 'label' => 'apellido paterno del cliente', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMatCliente', 'label' => 'apellido materno del cliente', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'puestoCliente', 'label' => 'puesto del cliente', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'correoCliente', 'label' => 'correo de contacto del cliente', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'numTelCliente', 'label' => 'numero telefonico del cliente', 'rules' => 'trim|required|min_length[15]'),
    ),

    /* Usuarios Insp */

    'InsertarUsuarioInsp_post' => array(
        array('field' => 'nombreUsuarioInsp', 'label' => 'nombre del usuario inspeccion', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePatUsInsp', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMatUsInsp', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'usuario', 'label' => 'nombre de usuario', 'rules' => 'trim|required|min_length[4]'),
        array('field' => 'claveAccesoUsInsp', 'label' => 'clave de acceso', 'rules' => 'trim|required|min_length[6]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
        array('field' => 'tipo', 'label' => 'tipo de usuario inspeccion', 'rules' => 'trim|required'),
    ),

    'actualizarUsuarioInsp_put' => array(
        array('field' => 'nombreUsuarioInsp', 'label' => 'nombre del usuario inspeccion', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePatUsInsp', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMatUsInsp', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'usuario', 'label' => 'nombre de usuario', 'rules' => 'trim|required|min_length[4]'),
        array('field' => 'tipo', 'label' => 'tipo de usuario inspeccion', 'rules' => 'trim|required')
    ),

    /* Usuarios Notif */

    'InsertarUsuarioNotif_post' => array(
        array('field' => 'nombre', 'label' => 'nombre', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePat', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMat', 'label' => 'apellido materno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'empresa', 'label' => 'nombre de la empresa', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'correo', 'label' => 'correo', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'usuario', 'label' => 'nombre del usuario notificacion', 'rules' => 'trim|required|min_length[4]'),
        array('field' => 'claveAcceso', 'label' => 'clave de acceso', 'rules' => 'trim|required|min_length[6]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarUsuarioNotif_put' => array(
        array('field' => 'nombre', 'label' => 'nombre', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePat', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMat', 'label' => 'apellido materno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'empresa', 'label' => 'nombre de la empresa', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'correo', 'label' => 'correo', 'rules' => 'trim|required|valid_email|min_length[6]'),
        array('field' => 'usuario', 'label' => 'nombre del usuario notificacion', 'rules' => 'trim|required|min_length[4]'),
    ),

    /* Operadores */
    /* En la app, no se valida numControlOp ni fechaVigLicOp.
       En el caso de la empresa es_transportista = 3, sí se valida numControlOp */
    'InsertarOperadores_post' => array(
        /* array('field' => 'numControlOp', 'label' => 'numero de control', 'rules' => 'trim|required|min_length[5]'), */
        array('field' => 'nombreOp', 'label' => 'nombre de operador', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePatOp', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMatOp', 'label' => 'apellido materno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numLicenciaOp', 'label' => 'numero de licencia', 'rules' => 'trim|required|min_length[4]'),
        /* array('field' => 'fechaVigLicOp', 'label' => 'fecha de vigencia de la licencia', 'rules' => 'trim|required|min_length[9]'), */
        array('field' => 'telefono', 'label' => 'telefono del operador', 'rules' => 'trim|required|min_length[16]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarOperador_put' => array(
        array('field' => 'numControlOp', 'label' => 'numero de control', 'rules' => 'trim|required|min_length[5]'),
        array('field' => 'nombreOp', 'label' => 'nombre de operador', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'apePatOp', 'label' => 'apellido paterno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'apeMatOp', 'label' => 'apellido materno', 'rules' => 'trim|required|min_length[2]'),
        array('field' => 'numLicenciaOp', 'label' => 'numero de licencia', 'rules' => 'trim|required|min_length[4]'),
        array('field' => 'fechaVigLicOp', 'label' => 'fecha de vigencia de la licencia', 'rules' => 'trim|required|min_length[9]'),
        array('field' => 'telefono', 'label' => 'telefono del operador', 'rules' => 'trim|required|min_length[16]'),

    ),

    /* Tipos movimientos */
    'insertatiposmovimientos_post' => array(
        array('field' => 'Nombre', 'label' => 'nombre del tipo movimiento', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'Descripcion', 'label' => 'descripcion', 'rules' => 'trim|required|min_length[6]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),
    
    'actualizarTipoMovimiento_put' => array(
        array('field' => 'Nombre', 'label' => 'nombre del tipo movimiento', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'Descripcion', 'label' => 'descripcion', 'rules' => 'trim|required|min_length[6]'),
    ),

    /* Marcas llantas */
    'insertamarcasllantas_post' => array(
        array('field' => 'Nombre', 'label' => 'nombre de la marca de llanta', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarMarcaLlantas_put' => array(
        array('field' => 'Nombre', 'label' => 'nombre de la marca de llanta', 'rules' => 'trim|required|min_length[3]'),
    ),

    /* Marcas tractocamiones */
    'InsertarMarcaTC_post' => array(
        array('field' => 'Nombre', 'label' => 'nombre de la marca de tractocamion', 'rules' => 'trim|required|min_length[3]'),
        array('field' => 'empresa_id', 'label' => 'empresa_id', 'rules' => 'trim|required|integer'),
    ),

    'actualizarMarcaTC_put' => array(
        array('field' => 'Nombre', 'label' => 'nombre de la marca de tractocamion', 'rules' => 'trim|required|min_length[3]'),
    ),

    /* Servidores */

    'servidores_agregar_post' => array(
        array('field' => 'nombre', 'label' => 'nombre del servidor', 'rules' => 'trim|required|min_length[1]'),
        array('field' => 'clave', 'label' => 'clave', 'rules' => 'trim|required|min_length[30]'),
    ),
    
    'servidores_modificar_put' => array(
        array('field' => 'servidor_id', 'label' => 'servidor', 'rules' => 'trim|required|integer'),
        array('field' => 'nombre', 'label' => 'nombre del servidor', 'rules' => 'trim|required|min_length[1]'),
        array('field' => 'clave', 'label' => 'clave', 'rules' => 'trim|required|min_length[30]'),
    ),

    /* Control Panico */

    'control_panico_agregar_post' => array(
        array('field' => 'usuario_insp_id', 'label' => 'usuario inbspección', 'rules' => 'trim|required|integer'),
        array('field' => 'tipo_movimiento_id', 'label' => 'tipo de movimiento', 'rules' => 'trim|required|integer'),
        array('field' => 'cliente_id', 'label' => 'cliente', 'rules' => 'trim|required|integer'),
        array('field' => 'empresa_id', 'label' => 'empresa', 'rules' => 'trim|required|integer'),
    ),
);

