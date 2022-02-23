<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
 

  class Cart {
    private $db;
    private $fm;

    public function __construct() {
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function addToCart($quantity, $id) {
      $quantity = $this->fm->validation($quantity);
      $quantity = mysqli_real_escape_string($this->db->link, $quantity);
      $productId = mysqli_real_escape_string($this->db->link, $id);
      $sId = session_id();

      $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
      $result = $this->db->select($squery)->fetch_assoc();

      $productName = $result['productName'];
      $price = $result['price'];
      $image = $result['image'];

      $checkQuery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
      $getResult = $this->db->select($checkQuery);
      if($getResult) {
          $msg = "Product already added to cart.";
          return $msg;
      } else {

      $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image)   VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
      $inserted_row = $this->db->insert($query);

      if($inserted_row) {
        header("Location:cart.php");

      } else {
        header("Location:404.php");
      }
    }
    }

    //Reading product details from database
    public function getCartProduct() {
      $sId = session_id();
      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
      $result = $this->db->select($query);
      return $result;
    }


    public function updateCartQuantity($quantity, $cartId) {
      $cartId = mysqli_real_escape_string($this->db->link, $cartId);
      $quantity = mysqli_real_escape_string($this->db->link, $quantity);

      $query = "UPDATE tbl_cart
                SET
                quantity = '$quantity'
                WHERE cartId = '$cartId'";

                $update_row = $this->db->update($query);
                if($update_row) {
                  header("Location:cart.php");
                  $msg = "<span class='success'> Quantity Updated Successfully. </span>";
                } else {
                  $msg = "<span class='success'> Quantity  Not Updated.  </span>";
                }
              return $msg;
    }

    ///Deleting product in cart
    public function deleteProductByCart($deleteId) {
      $deleteId = mysqli_real_escape_string($this->db->link, $deleteId);
      $query = "DELETE FROM tbl_cart WHERE cartId = '$deleteId'";
      $data = $this->db->delete($query);
      if($data) {
        $msg = "<span class='success'>window.location='cart.php';</span>";
      } else {
        $msg = "<span class='success'>Category not deleted.</span>";
      }
      return $msg;
    }

    //Reading data in cart table
    public function checkCartTable() {
      $sId = session_id();
      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
      $result = $this->db->select($query);
      return $result;
    }
  }
?>