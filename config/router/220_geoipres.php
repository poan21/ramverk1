<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Geographic IP controller.",
            "mount" => "api_geoip",
            "handler" => "\Anax\Controller\GeoipresController",
        ],
    ]
];
