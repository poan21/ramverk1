<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Geographic IP controller.",
            "mount" => "geoip",
            "handler" => "\Anax\Controller\GeoipController",
        ],
    ]
];
