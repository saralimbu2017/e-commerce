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
        
      } else {
        //insert query
        $query = "INSERT INTO tbl_category(catName) values('$catName')";
        $catinsert = $this->db->insert($query);
        //if successful to insert data display data to user
        if($catinsert) {
          $msg = "<span class='success'> Category inserted</span>";
          
         
        } else {
          //Display message on failure to insert data
          $msg = "<span class='error'> Category failed to be inserted</span>";
          
        }
        return $msg;
      }
    }

    //get the category list from database
    public function getAllCaterogies() {
      $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
      $result = $this->db->select($query);
      return $result;
    }

     //get the category of specific Id
     public function getCategoryById($id) {
      $query = "SELECT * FROM tbl_category  WHERE catId = '$id'";
      $result = $this->db->select($query);
      return $result;
    }

    //update category
    public function categoryUpdate($categoryName, $id) {
      $categoryName = $this->fm->validation($categoryName);
      $categoryName = mysqli_real_escape_string($this->db->link, $categoryName);
      $id = mysqli_real_escape_string($this->db->link, $id);
      if(empty($categoryName)) {
        $msg = "<span class='success'>Category field must not be empty.</span>";
        //return $msg;
      } else {
        $query = "UPDATE tbl_category
                  SET
                  catName = '$categoryName'
                  WHERE catId = '$id'";
        $update_row = $this->db->update($query);
        if($update_row) {
          $msg = "<span class='success'>Category updated successfully.</span>";
        } else {
          $msg = "<span class='success'>Category not inserted.</span>";
          
        }
        
      }
      return $msg;
    }
  }


?>