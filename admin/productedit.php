<?php 
  include_once 'inc/header.php';
  include_once 'inc/sidebar.php';
  include_once '../classes/Category.php';
  include_once '../classes/Product.php';
  include_once '../classes/Brand.php';
  
  if(!isset($_GET['productId']) || ($_GET['productId'] == NULL) ) {
    echo "<script> window.location = 'productedit.php'; </script>";
  }
  else {
    $id = $_GET['productId'];
  }

  $prod = new Product();

   //call productUpdate method of Product class is form is submitted
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']));
 
    $updateProduct =  $prod->productUpdate($_POST, $_FILES, $id);
  }
  ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">     
        <?php 
        if(isset($updateProduct)) {
            echo $updateProduct;
        }

        //get product of specific id
        $getProduct = $prod->getProductById($id);
        if($getProduct) {
          //loop through the product
          while($value = $getProduct->fetch_assoc()) {

         

        
        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            
                            <?php
                                $cat = new Category();
                                $getCat = $cat->getAllCategories();
                             
                                if($getCat) {
                                    while($result = $getCat->fetch_assoc()) {
                            ?>
                                    <option 
                                    <?php
                                      //select and display this option if value of option is equal to the $result[id]
                                      if($value['catId'] == $result['catId']) { ?>
                                    
                                        selected = "selected"
                                      <?php
                                      }

                                    ?>
                                    value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                                    <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php 
                                $brand = new Brand();
                                $getBrand = $brand->getAllBrands();
                                if($getBrand) {
                                    while($result = $getBrand->fetch_assoc()) {
                            ?>
                                    <option
                                    <?php
                                      if($value['brandId'] == $result['brandId']) { ?>
                                        selected = "selected"
                                    <?php
                                      }
                                    ?>
                                    value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                                
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                          <?php echo $value['body']; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="0">Featured</option>
                            <option value="1">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


