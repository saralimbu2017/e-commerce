<?php
  include_once '../lib/Database.php';
  include_once '../helpers/Format.php';

  class Category {
    private $db;
    private $fm;

    public function __construct() {
      $this->db = new Database();
      $this->fm = new Format();
    }

    //insert new category to database
    public function catInsert($catName) {
      $catName = $this->fm->validation($catName);
      $catName = mysqli_real_escape_string($this->db->link, $catName);
      if(empty($catName)) {
        $msg = "Category Field must not be empty. ";
        return $msg;
      } else {
        //insert query
        $query = "INSERT INTO tbl_category(catName) values('$catName')";
        $catinsert = $this->db->insert($query);
        //if successful to insert data display data to user
        if($catinsert) {
          $msg = "<span class='success'> Category inserted</span>";
          return $msg;
         
        } else {
          //Display message on failure to insert data
          $msg = "<span class='error'> Category failed to be inserted</span>";
          return $msg;
        }
      }
    }

    //get the category list from database
    public function getAllCaterogies() {
      $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
      $result = $this->db->select($query);
      return $result;
    }

  }


?>