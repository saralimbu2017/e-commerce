<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/Brand.php';

	//creating Brand object
	$brand = new Brand();

	//call method to delete category if delCat is set
	if(isset($_GET['delBrand'])) {
		$id = $_GET['delBrand'];
    
		$delBrand = $brand->deleteBrandById($id);
	}
?>
	<div class="grid_10">
		<div class="box round first grid">
			<h2>Brand List</h2>
			<div class="block">  
				<?php
					if(isset($delBrand)) {
						echo $delBrand;
					}
				?>
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							//get all the categories list
							$getBrand = $brand->getAllBrands();
							if($getBrand) {
								$i = 0;
								//loop through the categories
              
								while($result = $getBrand->fetch_assoc()) {
								$i++;
				
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="brandedit.php?brandId=<?php echo $result['brandId']; ?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to delete')" href="?delBrand=<?php echo $result['brandId']; ?>">Delete</a></td>
						</tr>
            
						<?php  	
								}
               
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

