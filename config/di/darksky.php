<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "darksky" => [
            "shared" => true,
            "callback" => function () {
                $darksky = new \Anax\Controller\CheckWeather();
                $cfg = $this->get("configuration");
                $config = $cfg->load("ApiKeys.php");
                $darksky->setKey($config['config']['darksky']);

                return $darksky;
            }
        ],
    ],
];
