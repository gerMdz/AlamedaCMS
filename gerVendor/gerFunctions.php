<?php
/**
 * Created by PhpStorm.
 * User: Gerardo Montivero gerardo.montivero@gmail.com
 * Date: 16/04/18
 * Time: 08:47
 */

date_default_timezone_set("America/Argentina/Mendoza");

$anio=date ('Y');

$mes = date ('m');

$dia=date('d');

//$anio='2018';
//
//$mes = '04';
//
//$dia='29';
$hora = date ('h:i:s');



# Obtenemos el numero de la semana

$semana=date("W",mktime(0,0,0,$mes,$dia,$anio));



# Obtenemos el día de la semana de la fecha dada

$diaSemana=date("w",mktime(0,0,0,$mes,$dia,$anio));



# el 0 equivale al domingo...

//if($diaSemana==0)
//
//    $diaSemana=7;



# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes

$primerDia=date("d-m-Y",mktime(0,0,0,$mes,$dia-$diaSemana+1,$anio));



# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo

$ultimoDia=date("d-m-Y",mktime(0,0,0,$mes,$dia+(7-$diaSemana),$anio));

$aa = substr($ultimoDia, 6, 4);
$mm = substr($ultimoDia, 3, 2);
$dd = substr($ultimoDia, 0, 2);

$muestroDia = ($diaSemana == 0) ? $anio . '/'. $mes . '/'. $dia : $aa .'/'.$mm .'/'.$dd;



?>