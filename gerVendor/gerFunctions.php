<?php
/**
 * Created by PhpStorm.
 * User: Gerardo Montivero gerardo.montivero@gmail.com
 * Date: 16/04/18
 * Time: 08:47
 */

date_default_timezone_set("America/Argentina/Mendoza");

//$anio=date ('Y');
//
//$mes = date ('m');
//
//$dia=date('d');
$hora = date ('h:i:s');

$anio=2018;

$mes=4;

$dia=22;

# Obtenemos el día de la semana de la fecha dada

$diaSemana=date("w",mktime(0,0,0,$mes,$dia,$anio));

# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes

$primerDia=date("d-m-Y",mktime(0,0,0,$mes,$dia-$diaSemana+1,$anio));


# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo

$ultimoDia=date("d-m-Y",mktime(0,0,0,$mes,$dia+(7-$diaSemana),$anio));

$muestroDia = ($diaSemana == 0) ? date($anio . '/'. $mes . '/'. $dia) : $ultimoDia;



?>