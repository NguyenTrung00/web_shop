<?php 
	include_once "lib/session.php";
	include_once "lib/session.php";
	$session = new Session();
	$session->init();
?>
<?php
	include "lib/database.php";
	include "helpers/format.php";
?>

<?php
	spl_autoload_register(function($className){
		include_once "classes/".$className.".php";
	});

	$fm = new Format();
	$cate = new Category();
	$brand = new Brand();
	$pro = new Product();
	$cart = new Cart();
	$cus = new Customer();
?>
<?php
	header("Cache-Control:no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: Fri, 10 March 2023 05:00:00 GMT");
	header("Cache-Control: max-age=2592000");	
?>


<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="POST">
				    	<input type="text" name="nameSearch" placeholder="Search for Products">
				    	<input type="submit" value="SEARCH" name="search">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product"><?php
									$check_cart = $cart->check_cart();
									if($check_cart->num_rows > 0){
										echo number_format($session->get("sum"))." VND";
									} else {
										echo "empty";
									}
								?></span>
							</a>
						</div>
			      </div>
			  <?php
					if(isset($_GET['idcus'])){
						$cart->delete_all_item();
						$session->destroy();
					}
				?>
		   <div class="login">
		   	<?php
		   			$check_login = $session->get("check_login");
			   		if($check_login == true){
			   			echo "<a href='?idcus=".$session->get("customer_id")."'>Logout</a>";
			   		} else {
			   			echo "<a href='login.php'>Login</a>";
			   		}
		   	?>
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="cart.php">Cart</a></li>
	  <?php
	  	if($session->get('check_login') == true){
	  		echo "<li><a href='profile.php?id_cus=".$session->get("customer_id")."'>Profile</a></li>";
	  		echo "<li><a href='orderdetail.php'>Order detail</a></li>";
	  	}
	  ?>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>