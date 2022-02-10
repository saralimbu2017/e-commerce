<?php 
class Format {
  //removing unwanted characters from received user input
  public function validation($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
}


?>