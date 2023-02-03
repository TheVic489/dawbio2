<?php
require '../../data/flights.php';
use practica\flights as flights; 

$flights = flights\getAllFlights();


echo json_encode($flights);
