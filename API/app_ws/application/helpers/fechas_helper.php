<?php
function fecha_formato_dashboard($str) {
    $fecha = strtotime($str);
    $fecha_str = date('d/M/Y', $fecha);
    $fecha_str = str_replace('Jan', 'Ene', $fecha_str);
    $fecha_str = str_replace('Apr', 'Abr', $fecha_str);
    $fecha_str = str_replace('Aug', 'Ago', $fecha_str);
    $fecha_str = str_replace('Dec', 'Dic', $fecha_str);
    return $fecha_str;
}
function dateToNodeFormat($originalDate)
{
    return date("Y-m-d\TH:i:s\.000\Z", strtotime($originalDate));
}
function datetimeMatamoros()
{
    $tz = 'America/Matamoros';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    return $dt;
}
