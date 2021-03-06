<?php 
	include 'includes/header.php'; 
	
	//Redirect to 404 page if productId is not set or null
	if(!isset($_GET['productId']) || $_GET['productId'] == NULL) {
		echo "<script>window.location = '404.php'; </script>";
	} else {
		$id = $_GET['productId'];
	}

	//Update brand details on form submission
	//$brand = new Brand();
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$quantity = $_POST['quantity'];
		$addCart = $cart->addToCart($quantity, $id);
	}


?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
					<?php
						$getProd = $prod->getSingleProduct($id);
						if($getProd) {
							while($result = $getProd->fetch_assoc()) {

					?>
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?> </h2>
					<p><?php echo $fm->textShorten($result['body'], 200); ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Add to Cart"/>
					</form>				
				</div>
				<span style="color:red; font-size: 18px; ">
					<?php
						if(isset($addCart)){
							echo $addCart;
						}
					?>
				</span>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
					<?php echo $result['body']; ?>
	    </div>
		<?php 			
					}
				}
					
	  ?>		
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
				      <li><a href="productbycat.html">Mobile Phones</a></li>
				      <li><a href="productbycat.html">Desktop</a></li>
				      <li><a href="productbycat.html">Laptop</a></li>
				      <li><a href="productbycat.html">Accessories</a></li>
				      <li><a href="productbycat.html#">Software</a></li>
					   <li><a href="productbycat.html">Sports & Fitness</a></li>
					   <li><a href="productbycat.html">Footwear</a></li>
					   <li><a href="productbycat.html">Jewellery</a></li>
					   <li><a href="productbycat.html">Clothing</a></li>
					   <li><a href="productbycat.html">Home Decor & Kitchen</a></li>
					   <li><a href="productbycat.html">Beauty & Healthcare</a></li>
					   <li><a href="productbycat.html">Toys, Kids & Babies</a></li>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
	<?php include 'includes/footer.php' ?>