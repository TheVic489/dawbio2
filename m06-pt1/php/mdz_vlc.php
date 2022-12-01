<?php

include "./fn_pt/fn_flys.php";

$mdr_vlc_time = 52;
$price = 35;

$mdr_vlc = get_arrival_array(HORAS_DE_SALIDA, $mdr_vlc_time);
$mdr_vlc['Preu'] = $price;

echo json_encode($mdr_vlc);

?>