<?php
	include 'includes/header.php';
	include 'includes/slider.php';
 ?>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php
				///Displaying product data from database
					$getFpd = $prod->getFeaturedProducts();
					if($getFpd) {
						while($result = $getFpd->fetch_assoc()) {
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?productId=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
					 <p><span class="price">$505.22</span></p>
				     <div class="button"><span><a href="preview.php?productId=<?php echo $result['productd']; ?>" class="details">Details</a></span></div>
				</div>
				<?php 	
						}
					}?>

			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

				<?php 
					$getNewProd = $prod->getNewProduct();
					if($getNewProd) {
						while($result = $getNewProd->fetch_assoc()) {

					
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?productId=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?> </h2>
					 <p><span class="price"><?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?productId=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				 <?php 	}
					} ?>
			
			</div>
    </div>
 </div>
</div>
<?php include 'includes/footer.php' ?>