<?php 
  include_once 'inc/header.php';
  include_once 'inc/sidebar.php';
  include_once '../classes/Brand.php';

  if(!isset($_GET['brandId']) || ($_GET['brandId'] == NULL) ) {
    echo "<script> window.location = 'brandlist.php'; </script>";
  }
  else {
    $id = $_GET['brandId'];
  }

  $brand = new Brand();
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $updateBrand =  $brand->brandUpdate($brandName, $id);
  }
  ?>

  <div class="grid_10">
    <div class="box round first grid">
      <h2>Add New Brand</h2>
      <div class="block copyblock"> 
        <?php 
          if(isset($updateBrand)) {
            echo $updateBrand;
          }

          $getBrand = $brand->getBrandById($id);
          if($getBrand) {
            while($result = $getBrand->fetch_assoc()) {

              
          ?> 
            <form method="post" action="">
              <table class="form">					
                  <tr>
                    <td>
                      <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                    </td>
                  </tr>
                  <tr> 
                    <td>
                      <input type="submit" name="submit" Value="Update" />
                    </td>
                  </tr>
              </table>
              </form>
              <?php   
                  }
                } 
              ?>
          </div>
      </div>
  </div>
<?php include 'inc/footer.php';?>