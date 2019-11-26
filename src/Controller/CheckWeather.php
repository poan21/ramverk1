<?php

namespace Anax\Controller;

class CheckWeather
{
    private $key;

    /**
     * Set key
     *
     * @param: string $key key to set.
     *
     */
    public function setKey($key)
    {
        $this->key = $key;
    }


    /**
     * multiCurl ip
     *
     * @param: array $pos where to create the curl.
     *
     * @return object With api results
     */
    public function multiCurl($pos, $formats)
    {
        $lat = $pos['latitude'];
        $long = $pos['longitude'];
        $url =  "https://api.darksky.net/forecast";
        $time = "12:00:00";
        $date = date("Y-m-d");
        $time = "12:00:00";

        if ($formats == "week") {
            $times = 7;
        } elseif ($formats == "month") {
            $times = 30;
        }

        $options = [
                CURLOPT_RETURNTRANSFER => true,
        ];

        $mh = curl_multi_init();
        $chAll = [];

        $newdate = date('Y-m-d', (strtotime('1 day', strtotime($date))));

        while ($times > 0) {
            $ch = curl_init("$url/$this->key/$lat,$long,{$date}T$time");
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mh, $ch);
            $chAll[] = $ch;
            if ($formats == "week") {
                $date = date('Y-m-d', (strtotime('1 day', strtotime($date))));
            } elseif ($formats == "month") {
                $date = date('Y-m-d', (strtotime('-1 day', strtotime($date))));
            }
            $times = $times - 1;
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }

        curl_multi_close($mh);

        $response = [];
        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $response[] = json_decode($data, true);
        }

        return $response;
    }
}
