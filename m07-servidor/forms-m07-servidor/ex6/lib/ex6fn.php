<?php

const price_potatoes = [
    ['from' => 0, 'to' => 20, 'pricePerKg' => 49,9],
    ['from' => 20, 'to' => 50, 'pricePerKg' => 30,9],
    ['from' => 50, 'to' => 80, 'pricePerKg' => 20,9],
    ['from' => 80, 'to' => 1000, 'pricePerKg' => 10,9]
];  

/**
 * calculates the price of the potatoes quantity given
 * @param float $potato_kg Potatos quantity (kg)
 * @return $pricePerKg the price
 */
function priceCalc (float $potato_kg){
    $pricePerKg = 0.0;
    foreach (price_potatoes as $interval) {
        if ( ($potato_kg > $interval['from']) && ($potato_kg < $interval['to']) ) {
            $pricePerKg = $interval['pricePerKg'];
        }
    }
    return $pricePerKg;
}  