<?php


namespace App\Models\Helpers;


class ParseHTMLHelper
{

    private $_page;
    private $_tags_array;
    public function init($html_page){
        $this->_page = $html_page;

    }
    public function find($tag,$params = []){

    }
    private function fillTagsArrayRecursive(){

    }
    public static function textToArray($text){
        $main_tag = preg_match('/<.*>/',$text,$matches);
        $main_tag = $matches[0];
        $main_tag = trim($main_tag,'<>');

        return $matches;
    }

}