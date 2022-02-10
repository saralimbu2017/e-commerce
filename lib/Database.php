<?php
  class Database {

    //Database settings
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbname = DB_NAME;

    public $link;
    public $error;

    //constructor method automatically loadding connectDb method to setup connection with database
    public function __construct() {
      $this->connectDB();
    }

    //Setting up database connection
    public function connectDB() {
      $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

      //generate error if database connection fails
      if(!$this->link) {
        $this->error = "Connection fail".$this->link->connect_error;
        return false;
      }
    }

    //Querying data
    public function select($query) {
      $result = $this->link->query($query) or die($this->link->error.__LINE__);
      if($result->num_rows > 0) {
        return $result;
      } else  {
        return false;
      }
    }

    //Insert data into database
    public function insert($query) {
      $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
      if($insert_row) {
        header("Location: index.php?msg=".urlencode('Data inserted'));
        exit();
      } else {
        die("Error:(".$this->link->error.")".$this->link->error);
      }

    }

      //Update data in database
      public function update($query) {
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($update_row) {
          header("Location: index.php?msg=".urlencode('Data inserted'));
          exit();
        } else {
          die("Error:(".$this->link->error.")".$this->link->error);
        }
  
      }

        //Delete data in database
        public function delete($query) {
          $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
          if($delete_row) {
            header("Location: index.php?msg=".urlencode('Data deleted'));
            exit();
          } else {
            die("Error:(".$this->link->error.")".$this->link->error);
          }
    
        }
  }



?>