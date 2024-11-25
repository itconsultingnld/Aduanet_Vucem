<?php
function rutaBase()
{
    // return "/home/vhten3/lite.keex.mx/";
    return "C:\\xampp\\htdocs\\Qsacs\\Web\\KeexLite\\";
}

function rutaDivisor()
{
    // return "/";
    return "\\";
}

function daniosFormato($string) {
    $string = str_replace('espejoLatIzq,', 'Espejo lateral izquierdo,', $string);
    $string = str_replace('espejoLatDer,', 'Espejo lateral derecho,', $string);
    $string = str_replace('llantasBajaPresion,', 'Llantas con baja presión,', $string);
    $string = str_replace('TC_defensa,', 'Defensa,', $string);
    $string = str_replace('TC_luzDireccDelantIzq,', 'Luces y direccionales delanteras lado izquierdo,', $string);
    $string = str_replace('TC_LlantasDelantIzq,', 'Llanta delantera lado izquierdo,', $string);
    $string = str_replace('TC_Techo,', 'Techo,', $string);
    $string = str_replace('TC_PisoInter,', 'Piso interior,', $string);
    $string = str_replace('TC_cabinaCamarote,', 'Cabina y camarote,', $string);
    $string = str_replace('TC_equipHerram,', 'Área de equipaje y herramientas,', $string);
    $string = str_replace('TC_sinPlagas,', 'Sin plagas,', $string);
    $string = str_replace('TC_basura,', 'Sin basura,', $string);
    $string = str_replace('TC_tanqDiesel,', 'Tanque de Diesel,', $string);
    $string = str_replace('TC_tanqAire,', 'Tanque de aire,', $string);
    $string = str_replace('TC_quintaRueda,', 'Quinta rueda,', $string);
    $string = str_replace('TC_chasisPisoExt,', 'Chasis y piso exterior,', $string);
    $string = str_replace('TC_LlantasTraserasIzq,', 'Llantas traseras lado izquierdo,', $string);
    $string = str_replace('TC_LuzTrasIzq,', 'Luces traseras lado izquierdo,', $string);
    $string = str_replace('TC_luzDirTrasDer,', 'Luces y direccionales traseras lado derecho,', $string);
    $string = str_replace('TC_luzTrasDer,', 'Luz trasera lado derecho,', $string);
    $string = str_replace('TC_LlantasTraserasDer,', 'Llantas traseras lado derecho,', $string);
    $string = str_replace('TC_escape,', 'Escape,', $string);
    $string = str_replace('TC_motor,', 'Motor,', $string);
    $string = str_replace('TC_luzDireccDelantDer,', 'Luces y direccionales delanteras lado derecho,', $string);
    $string = str_replace('TC_LlantasDelantDer,', 'Llantas delanteras lado derecha,', $string);
    $string = str_replace('SR_pernoRey,', 'Perno rey y placa,', $string);
    $string = str_replace('SR_paredLatExt,', 'Pared lateral exterior izquierdo,', $string);
    $string = str_replace('SR_chasisPisoExt,', 'Chasis y piso exterior,', $string);
    $string = str_replace('SR_llantasTraseras,', 'Llantas traseras lado izquierdo,', $string);
    $string = str_replace('SR_puertaPartExt,', 'Puertas parte exterior,', $string);
    $string = str_replace('SR_puertasInt,', 'Puertas parte interior,', $string);
    $string = str_replace('SR_bisagras,', 'Bisagras,', $string);
    $string = str_replace('SR_mecanCierre,', 'Mecanismo de cierre,', $string);
    $string = str_replace('SR_defensa,', 'Defensa,', $string);
    $string = str_replace('SR_luzTrasExtIzq,', 'Luces traseras lado izquierdo,', $string);
    $string = str_replace('SR_luzTrasExtDer,', 'Luces traseras lado derecho,', $string);
    $string = str_replace('SR_paredIntLateral,', 'Paredes internas laterales,', $string);
    $string = str_replace('SR_paredIntFrontal,', 'Pared interna frontal,', $string);
    $string = str_replace('SR_pisoInt,', 'Piso interior,', $string);
    $string = str_replace('SR_techoInt,', 'Techo interior,', $string);
    $string = str_replace('SR_olores,', 'Sin olores,', $string);
    $string = str_replace('SR_plagas,', 'Sin plagas,', $string);
    $string = str_replace('SR_excesoTierraLodo,', 'Exceso de tierra o lodo,', $string);
    $string = str_replace('SR_basura,', 'Sin basura,', $string);
    $string = str_replace('SR_selloVVTT,', 'Revisión de Sellos VVTT,', $string);
    $string = str_replace('SR_luzTrasDer,', 'Luz trasera lado derecho,', $string);
    $string = str_replace('SR_llantasTraseras,', 'Llantas traseras lado derecho,', $string);
    $string = str_replace('SR_techoExt,', 'Techo exterior,', $string);
    $string = str_replace('SR_paredLatExtDer,', 'Pared lateral exterior lado derecho,', $string);
    $string = str_replace('SR_paredExtFrontal,', 'Pared externa frontal,', $string);
    $string = str_replace('SR_unidadRefrig,', 'Unidad refrigerada,', $string);

    return $string;
}
