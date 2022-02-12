<?php 
  include_once 'inc/header.php';
  include_once 'inc/sidebar.php';
  include_once '../classes/Category.php';

  if(!isset($_GET['catId']) || $_GET['catId'] == NULL) {
    echo "<script> window.location = 'catlist.php'; </script>";
  } else {
    $id = $_GET['catId'];
  }

  $cat = new Category();
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $catName = $_POST['catName'];
      $insertCat =  $cat->catInsert($catName);
  }
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php 
                    if(isset($insertCat)) {
                        echo $insertCat;
                    }

                    $getCategory = $cat->getCategoryById($id);
                    if($getCategory) {
                      while($result = $getCategory->fetch_assoc()) {

                    
                ?> 
                 <form method="post" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
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