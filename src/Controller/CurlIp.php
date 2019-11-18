<?php

namespace Anax\Controller;

include_once 'apiKey.php';

class CurlIp
{


    /**
     * Curl ip
     *
     * @param: string $url where to create the curl.
     *
     * @return object With api results
     */
    public function curl($ip)
    {
        $key = new ApiKey();
        $access_key = $key->getKey();
        $url = 'http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'';

        // Initialize CURL:
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $api_result = json_decode($json, true);

        return $api_result;
    }
}
