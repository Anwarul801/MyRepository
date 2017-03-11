<?php

/**
*
*/
class Formate
{
   public function formateDate($date){
   	return date('F ,Y,g:i a',strtotime($date));
   }

   public function readmore($text, $limit = 400){
        $text = $text."";
        $text = substr($text,0, $limit);
        $text = substr($text,0, strripos($text, ' '));
        $text = $text.".....";
        return $text;

   }
   public function validation($data){
     $data = trim($data);
     $data = stripcslashes($data);
     return $data;
   }
}


?>
