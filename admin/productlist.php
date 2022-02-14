<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/Product.php';
	include_once '../helpers/Format.php';

	$prod = new Product();
	$fm = new Format();

	//on clicking delete button, call deleteProductById method
	if(isset($_GET['delproduct'])) {
		$id = $_GET['delproduct'];
		$delproduct = $prod->deleteProductById($id);
	}
?>
	<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
				<?php
				//Display message after deleting product
					if(isset($delproduct)) {
						echo $delproduct;
					}

				?>
        <table class="data display datatable" id="example">
				<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
					//get product list from the database
					$getProd = $prod->getAllProducts();
					if($getProd) {
						$i=0;
						//loop through the list
						while($result = $getProd->fetch_assoc()) {
							$i++;
					

 			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?> </td>
					<td><?php echo $fm->textShorten($result['productName'], 15); ?></td>
					<td><?php echo $result['catId']; ?></td>
					<td><?php echo $result['brandId']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
					<td><?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px";></td>
					<td><?php 
					if($result['type'] == 0) {
						echo "Featured";
					} else {
						echo "General";
					}
					 ?></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId']; ?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to delete')" href="?delproduct=<?php echo $result['productId']; ?>">Delete</a></td>
				</tr>
				<?php	}
				} ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
