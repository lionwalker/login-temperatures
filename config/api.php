<?php

return [
    // api key of open weather
    'api_key' => env('OPEN_WEATHER_MAP_API_KEY'),

    // Default locations of cities
    'cities' => [
        'Colombo' => [
            'lat' => '6.9271',
            'long' => '79.8612'
        ],
        'Melbourne ' => [
            'lat' => '37.8136',
            'long' => '144.9631'
        ],
    ],
];
