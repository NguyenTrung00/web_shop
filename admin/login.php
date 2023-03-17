<?php
	include "../classes/adminlogin.php";
?>
<?php
	$admin = new AdminLogin();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(isset($_POST['adminLogin'])){
			$adminName = $_POST['adminName'];
			$adminPass = $_POST['adminPass'];

			$login_check = $admin->login_admin($adminName, $adminPass);
		}
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
		<form action="login.php" method="post" autocomplete="off">
			<h1>Admin Login</h1>
			<span>
				<?php
					if(isset($login_check)){
						echo $login_check;
					}
				?>
			</span>
			<div>
				<input type="text" placeholder="Username" required="" name="adminName"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" name="adminLogin"/>
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>