<?php
  include '../lib/Database.php';
  include '../helpers/Format.php';

  class Category {
    private $db;
    private $fm;

    public function __construct() {
      $this->db = new Database();
      $this->fm = new Format();
    }

  }


?>