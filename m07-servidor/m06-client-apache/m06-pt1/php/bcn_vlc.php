
<?php

include "./fn_pt/fn_flys.php";

$bcn_mdr_time = 1 * 60 + 7;
$preu = 57;

$bcn_vlc = get_arrival_array(HORAS_DE_SALIDA, $bcn_vlc_time);
$bcn_vlc['Preu'] = $preu;

echo json_encode($bcn_vlc); 