<?php

include "./fn_pt/fn_flys.php";

$bcn_mdr_time = 1 * 60 + 7;

$bcn_mdr = get_arrival_array(HORAS_DE_SALIDA, $bcn_mdr_time);
$bcn_mdr['Preu'] = 55;

echo json_encode($bcn_mdr);

?>