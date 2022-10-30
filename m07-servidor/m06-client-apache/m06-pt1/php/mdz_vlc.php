<?php

include "./fn_pt/fn_flys.php";

$mdr_vlc_time = 1 * 60 + 7;
$price = 35;

$mdr_vlc = get_arrival_array(HORAS_DE_SALIDA, $md_vlc_time);
$mdr_vlc['Preu'] = $price;

echo json_encode($barcelona_madrid);

?>