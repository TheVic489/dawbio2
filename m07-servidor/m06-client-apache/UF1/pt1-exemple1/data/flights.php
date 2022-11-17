<?php
namespace practica\flights;

function getAllFlights(){
    
    // The amount of time is in MINUTES!!
    // Prices are meant in EUROS!!

    return [
        'routes' => [
            'Barcelona' => ['Madrid'   => ['time' => 67, 'price' => 55],
                            'Valéncia' => ['time' => 57, 'price' => 57]],

            'Madrid'    => ['Barcelona' => ['time' => 67, 'price' => 55],
                            'Valéncia'  => ['time' => 57, 'price' => 57]],

            'Valéncia'  => ['Barcelona' => ['time' => 57, 'price' => 40],
                            'Madrid'    => ['time' => 52, 'price' => 35]]
        ],

        'schedules' => [
            'Monday'     => ['08:00', '17:00'],
            'Tuesday'    => [],
            'Wednesday'  => [],
            'Thursday'   => [],
            'Friday'     => ['07:00', '19:30'],
            'Saturday'   => ['14:00'],
            'Sunday'     => []
        ]
    ];

}
