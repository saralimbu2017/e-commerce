<?php
class Session {
  //initializing session

  // public function __construct() {
  //   session_start();
  // }
  public static function init() {
    session_start();
  }

  //setting session variables
  public static function set($key, $value) {
    $_SESSION[$key] = $value;
  }

  //Checking if session variable is set
  public static function get($key) {
    if(isset($_SESSION[$key])) {
      return $_SESSION[$key];
    } else {
      return false;
    }
  }

  //check if adminlogin is set
  public static function checkLogin() {
    self::init();
    if(self::get("adminlogin") == true) {
      
      header("Location:dashboard.php");
    }
  }

  //logging out the user
  public static function checkSession() {
    self::init();
    if(self::get("adminlogin") == false) {
      self::destroy();
      header("Location:login.php");
    }
  }

  //destroy session
  public static function destroy() {
    session_destroy();
    header("Location:login.php ");
  }

}


?>