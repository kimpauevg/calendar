<?php

namespace App\Models\Helpers;

class RequestHelper
{

    public static function GET($url, $params = null,$request_params = null){
        if ($params) $url = $url = $url.'?'.http_build_query($params);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);


        return self::endRequest($curl,$request_params);
    }
    public static function POST($url, array $params = null, array $request_params = []){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($params)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        return self::endRequest($curl,$request_params);

    }
    protected static function endRequest($curl,$request_params){
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/html; charset=UTF-8',
            'Accept-Language: ru'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla');
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        $code = curl_getinfo($curl,CURLINFO_RESPONSE_CODE);
        if ($code >= 400) {
            $result = false;
        }
        curl_close($curl);
        return $result;


    }
//    public static function checkURL($url){
//        $url_charachters = ' -.~!*\'();:@&=+$,/?%#[]';
//        return preg_match('@https?:\/\/\w+(\.\w+)+(:\d+)?\/(\w+\/?){0,}\?((.*=.*&){0,}.*=.*)?/@',$url);
//    }
}