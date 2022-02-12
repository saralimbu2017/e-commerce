<?php 
  include_once 'inc/header.php';
  include_once 'inc/sidebar.php';
  include_once '../classes/Brand.php';

  $brand = new Brand();
  //call brandInsert method of Brand class if form is submitted
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $insertBrand =  $brand->brandInsert($brandName);
  }
 ?>

  <div class="grid_10">
    <div class="box round first grid">
      <h2>Add New Category</h2>
      <div class="block copyblock"> 
      <?php 
        if(isset($insertBrand)) {
            echo $insertBrand;
        }
      ?> 
      <form method="post" action="">
        <table class="form">					
          <tr>
            <td>
                <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
            </td>
          </tr>
          <tr> 
            <td>
                <input type="submit" name="submit" Value="Save" />
            </td>
          </tr>
        </table>
      </form>
      </div>
    </div>
  </div>
<?php include 'inc/footer.php';?>