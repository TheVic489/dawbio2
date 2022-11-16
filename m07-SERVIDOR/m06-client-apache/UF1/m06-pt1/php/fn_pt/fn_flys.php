
<?php

const HORAS_DE_SALIDA = [
    "dilluns" => ["8:00", "17:00"],
    "divendres" => ["7:00", "19:30"],
    "dissapte" => ["14:00"],
];


function get_arrival_time(string $hora_salida, int $duracion_vuelo): string{
 
    $segundos_horaInicial=strtotime($hora_salida);
    
    $segundos_a_anadir=$duracion_vuelo*60;
     
    $hora_llegada=date("H:i",$segundos_horaInicial+$segundos_a_anadir);
     
    return $hora_llegada;
}

function get_arrival_array($horas_de_sortida, $hora_vuelo) {
    $llegada_array_viaje = [];
    foreach ($horas_de_sortida as $dia) {
        $llegada_array_dia = array();
        foreach ($dia as $hora) {
            $hora_llegada = get_arrival_time($hora, $hora_vuelo);
            array_push($llegada_array_dia, $hora_llegada);
        }
        array_push($llegada_array_viaje, $llegada_array_dia);
    }
    return $llegada_array_viaje;
}

?>