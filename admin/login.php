<?php 
	include '../classes/Adminlogin.php';
		//creating adminLogin object
		$admLogin = new AdminLogin();

		//checking if Post method is submitted
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$adminUser = $_POST['adminUser'];
			$adminPass = $_POST['adminPass'];
	
			//user authentication
			$loginCheck = $admLogin->adminLogin($adminUser, $adminPass);
		}
	
	
	?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body> 
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color:red; font-size: 18px;">
		  <?php
			//display the respective message after checking user input
				if(isset($loginCheck)) {
					echo $loginCheck;
				}
			?>
			</span>
			<div>
				<input type="text" placeholder="Username" required="" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>