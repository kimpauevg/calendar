<?php
namespace App\Http\Controllers\Auth\check;

class CheckController extends \App\Http\Controllers\Controller
{
    public function check($word){
        return "I checked it: you said {$word}";
    }

}