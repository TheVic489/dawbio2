
<?php

include "./fn_pt/fn_flys.php";

$bcn_vlc_time = 57;
$preu = 40;

$bcn_vlc = get_arrival_array(HORAS_DE_SALIDA, $bcn_vlc_time);
$bcn_vlc['Preu'] = $preu;

echo json_encode($bcn_vlc); 