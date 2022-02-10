<?php
include '../lib/Session.php';
include '../lib/Database.php';
include '../helpers/Format.php';

class Adminlogin {

  private $db;
  private $fm;

  //initializing database and Format class objects
  public function __construct() {
      $this->db = new Database();
      $this->fm = new Format();
  }

  //Setting session varibles with admin data
  public function adminLogin($adminUser, $adminPass) {
    //Validating user input data
    $adminUser = $this->fm->validation($adminUser);
    $adminPass = $this->fm->validation($adminPass);

    //escaping special characters for use in SQL query
    $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
    $adminUser = mysqli_real_escape_string($this->db->link, $adminPass);

    //Check if user input is empty
    if(empty($adminUser) || empty($adminPass)) {
      $loginmsg = "User name or Password must not be empty";
      return $loginmsg;
    } else {
      //set session variables with valid user input
      $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
      $result = $this->db->select($query);
      if($result != false) {
        $value = $result->fetch_assoc();
        Session::set("adminlogin", true);
        Session::set("adminId", $value['adminId']);
        Session::set("adminUser", $value['adminUser']);
        Session::set("adminName", $value['adminName']);
        header("Location:dashboard.php");
      } else {
        $loginmsg = "Username or password not matched";
        return $loginmsg;
      }
    }
  }
}
?>