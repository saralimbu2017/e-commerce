<?php
  include_once '../lib/Database.php';
  include_once '../helpers/Format.php';

  class Product {
    private $db;
    private $fm;

    public function __construct() {
      $this->db = new Database();
      $this->fm = new Format();
    }

    //insert new product to database
    public function productInsert($data, $file) {
      $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
      $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
      $brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
      $body = mysqli_real_escape_string($this->db->link, $data['body']);
      $price = mysqli_real_escape_string($this->db->link, $data['price']);
      $type = mysqli_real_escape_string($this->db->link, $data['type']);

      //restricting file format
      $permitted = array('jpg','png','jpeg','gif');
      $file_name = $file['image']['name'];
      $file_size = $file['image']['size'];
      $file_temp = $file['image']['tmp_name'];

      //Naming each file with unique name and defining the path
      $div = explode('.',$file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $uploaded_image = "../admin/upload/".$unique_image;


      if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $type == "") {
        $msg = "<span class='error'> Product Field must not be empty.</span> ";
        
      } else {
        //moving uploaded file to specified path
        move_uploaded_file($file_temp, $uploaded_image);
        //insert query
        $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) values('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
        $productinsert = $this->db->insert($query);
        //if successful to insert data display data to user
        if($productinsert) {
          $msg = "<span class='success'> Product inserted</span>";
          
         
        } else {
          //Display message on failure to insert data
          $msg = "<span class='error'> Product failed to be inserted</span>";
          
        }
        return $msg;
      }
    }

    //get the category list from database
    public function getAllProducts() {
      $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product
      INNER JOIN tbl_category
      ON tbl_product.catId = tbl_category.catId
      INNER JOIN tbl_brand
      ON tbl_product.brandId = tbl_brand.brandId
      ORDER BY tbl_product.productId DESC";
      $result = $this->db->select($query);
      return $result;
    }

     //get the category of specific Id
     public function getProductById($id) {
      $query = "SELECT * FROM tbl_product  WHERE productId = '$id'";
      $result = $this->db->select($query);
      return $result;
    }

    //update category
    public function productUpdate($productName, $id) {
      $productName = $this->fm->validation($productName);
      $productName = mysqli_real_escape_string($this->db->link, $productName);
      $id = mysqli_real_escape_string($this->db->link, $id);
      if(empty($productName)) {
        $msg = "<span class='success'>Product field must not be empty.</span>";
        //return $msg;
      } else {
        $query = "UPDATE tbl_product
                  SET
                  productName = '$productName'
                  WHERE productId = '$id'";
        $update_row = $this->db->update($query);
        if($update_row) {
          $msg = "<span class='success'>Product updated successfully.</span>";
        } else {
          $msg = "<span class='success'>Product not inserted.</span>";
          
        }
        
      }
      return $msg;
    }

    //delete Category of specific id
    public function deleteProductById($id) {
      $query = "DELETE FROM tbl_product WHERE productId = '$id'";
      echo $query;
      $deldata = $this->db->delete($query);
      if($deldata) {
        $msg = "<span class='success'> product Deleted Successfully.</span>";
      } else {
        $msg = "<span class='success'> product cannot be Deleted.</span>";
      }
      return $msg;
    }
  }




?>