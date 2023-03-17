<?php
	include "include/header.php";
	// include "include/slider.php";
?>
<?php
	if(isset($_GET['idpro']) && $_GET['idpro'] != NULL){
		$id = $_GET['idpro'];
	} else {
		echo "<script>window.location='index.php'</script>";
	}
?>

<?php
	$add_cart = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
		$quantity =  $_POST['proQuantity'];
		$add_cart = $cart->addToCart($id, $quantity);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    			$get_pro = $pro->getProduct($id);
    			if($get_pro){
    				while($row = $get_pro->fetch_assoc()){

    		?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?=$row['image'];?>" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?=$row['proName'];?></h2>
					<p><?php
						echo $fm->textShorten($row['description'],10);
					?></p>					
					<div class="price">
						<p>Price: <span><?php echo number_format($row['proPrice'])." VND";?></span></p>
						<p>Category: <span><?=$row['catName'];?></span></p>
						<p>Brand:<span><?=$row['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="proQuantity" value="1" min="1" />
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
					<?php
						if(isset($add_cart)){
							echo $add_cart;
						} else {
							echo "";
						}
					?>
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?=$row['description'];?></p>

	        <?php
	        		}
	        	}
	        ?>
	    </div>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
							$getAllCate = $cate->show_category();
							if($getAllCate){
								while ($row = $getAllCate->fetch_assoc()) {
						?>
				      <li><a href="productbycat.php?idcate=<?=$row['idCategory'];?>"><?=$row['catName'];?></a></li>
				      <?php
				      		}
				      	}
				      ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
<?php
	include "include/footer.php";
?>