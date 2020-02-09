<?php


class Calendar extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'placeholder';

    public static function fetchInfo($date = null){
        if (!$date) $date = time();
        else $date = strtotime($date);

        $year = date('Y',$date);
        $week = date('W',$date);
        curl_init("https://rasp.tpu.ru/gruppa_33317/{$year}/{$week}/view.html");
    }

}