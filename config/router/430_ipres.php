<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Json controller.",
            "mount" => "json",
            "handler" => "\Anax\Controller\JsonController",
        ],
    ]
];
