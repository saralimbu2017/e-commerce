<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/Category.php';

	//creating Category object
	$cat = new Category();
	//call method to delete category if delCat is set
	if(isset($_GET['delcat'])) {
		$id = $_GET['delcat'];
		$delCat = $cat->deleteCategoryById($id);
	}
?>
	<div class="grid_10">
		<div class="box round first grid">
			<h2>Category List</h2>
			<div class="block">  
				<?php
					if(isset($delCat)) {
						echo $delCat;
					}
				?>
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							//get all the categories list
							$getCategory = $cat->getAllCaterogies();
							if($getCategory) {
								$i = 0;
								//loop through the categories
								while($result = $getCategory->fetch_assoc()) {
								$i++;
				
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="catedit.php?catId=<?php echo $result['catId']; ?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to delete')" href="?delcat=<?php echo $result['catId']; ?>">Delete</a></td>
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

