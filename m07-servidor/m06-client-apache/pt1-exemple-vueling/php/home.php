<?php
$info = file_get_contents('php://input');
$cities = ["Barcelona","Valencia","Malaga","Madrid"];
echo json_encode($cities);
