<?php 
class Format {
  //removing unwanted characters from received user input
  public function validation($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


   //reducing the legth of text
   public function textShorten($text, $limit=400 ) {
    $text = $text."";
    $text = substr($text, 0, $limit);
    $text = $text."...";
    return $text;
  }
}


?>