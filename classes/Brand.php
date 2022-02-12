<?php
  include_once '../lib/Database.php';
  include_once '../helpers/Format.php';

  class Brand {
    private $db;
    private $fm;

    public function __construct() {
      $this->db = new Database();
      $this->fm = new Format();
    }

    //insert new category to database
    public function brandInsert($brandName) {
      $brandName = $this->fm->validation($brandName);
      $brandName = mysqli_real_escape_string($this->db->link, $brandName);
      if(empty($brandName)) {
        $msg = "Brand Field must not be empty. ";
        
      } else {
        //insert query
        $query = "INSERT INTO tbl_brand(brandName) values('$brandName')";
        $brandinsert = $this->db->insert($query);
        //if successful to insert data display data to user
        if($brandinsert) {
          $msg = "<span class='success'> Brand inserted</span>";
          
         
        } else {
          //Display message on failure to insert data
          $msg = "<span class='error'> Brand failed to be inserted</span>";
          
        }
        return $msg;
      }
    }

    //get the category list from database
    public function getAllBrands() {
      $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
      $result = $this->db->select($query);
      return $result;
    }

     //get the category of specific Id
     public function getBrandById($id) {
      $query = "SELECT * FROM tbl_brand  WHERE brandId = '$id'";
      $result = $this->db->select($query);
      return $result;
    }

    //update category
    public function brandUpdate($brandName, $id) {
      $brandName = $this->fm->validation($brandName);
      $brandName = mysqli_real_escape_string($this->db->link, $brandName);
      $id = mysqli_real_escape_string($this->db->link, $id);
      if(empty($brandName)) {
        $msg = "<span class='success'>Brand field must not be empty.</span>";
        //return $msg;
      } else {
        $query = "UPDATE tbl_brand
                  SET
                  brandName = '$brandName'
                  WHERE brandId = '$id'";
        $update_row = $this->db->update($query);
        if($update_row) {
          $msg = "<span class='success'>Brand updated successfully.</span>";
        } else {
          $msg = "<span class='success'>Brand not inserted.</span>";
          
        }
        
      }
      return $msg;
    }

    //delete Category of specific id
    public function deleteBrandById($id) {
      $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
      $deldata = $this->db->delete($query);
      if($deldata) {
        $msg = "<span class='success'> Brand Deleted Successfully.</span>";
      } else {
        $msg = "<span class='success'> Brand cannot be Deleted.</span>";
      }
      return $msg;
    }
  }




?>