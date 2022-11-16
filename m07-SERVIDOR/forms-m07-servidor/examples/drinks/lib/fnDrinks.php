<?php

namespace proven\drinks;

//array of drinks and prices
$drinkFare = [
    'water' => 1.0,
    'lemonade' => 1.5,
    'beer' => 2.0,
    'tonic water' => 1.75
];

/**
 * get all drinks
 * @global array $drinkFare the array to get keys from
 * @return array of keys with drink names
 */
function getAllDrinks(): array {
    global $drinkFare;
    return array_keys($drinkFare);
}

/**
 * gets the price of the given drink
 * @global array $drinkFare the array to search in
 * @param string $drink the drink name to search
 * @return float the price of the drink
 * @throws \Exception if drink is not found
 */
function getDrinkPrice(string $drink): float {
    global $drinkFare;
    $price = 0.0;
    if (array_key_exists($drink, $drinkFare)) {
        $price = $drinkFare[$drink];
    } else {
        throw new \Exception("drink not found", -1);
    }
    return $drinkFare[$drink];
}
