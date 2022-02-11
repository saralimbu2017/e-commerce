﻿<?php 
 include_once 'inc/header.php';
 include_once 'inc/sidebar.php';
 include_once '../classes/Category.php';

 $cat = new Category();
 if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $catName = $_POST['catName'];
     $insertCat =  $cat->catInsert($catName);
     if($insertCat) {
        header("Location: dashboard.php?msg=".urlencode('Data inserted'));
     }
 }
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
              <?php 
                    // if(isset($insertCat)) {
                    //     echo $insertCat;
                    // }
                ?> 
                 <form method="post" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Enter Category Name..." class="medium" />
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