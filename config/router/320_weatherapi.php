<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather controller.",
            "mount" => "api_weather",
            "handler" => "\Anax\Controller\WeatherApiController",
        ],
    ]
];
