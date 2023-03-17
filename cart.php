<?php
include "include/header.php";
// include "include/slider.php";
?>
<?php
	if(isset($_GET['iddel']) && $_GET['iddel'] != NULL){
		$id = $_GET['iddel'];
		$delete_item_cart = $cart->delete_item_cart($id);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {
		$id_cart = $_POST['idCart'];
		$quantity_item = $_POST['quantity_item'];
		$update_quantity_cart = $cart->update_quantity_cart($id_cart,$quantity_item);
		if($update_quantity_cart){
			echo "<script>window.confirm='Update Successfully.'</script>";
		}

		if($quantity_item < 0){
			$cart->delete_item_cart($id_cart);
		}
	}
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2>Your Cart</h2>
				<table class="tblone">
					<tr>
						<th>ID</th>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
						$get_cart = $cart->show_cart();
						if($get_cart){
							$i=0;
							$thanhtien=0;
							$total=0;
							$grandTotal= 0;
							while($row = $get_cart->fetch_assoc()){
								$i++;
								$thanhtien = $row['proPrice'] * $row['quantity'];
								$total+=$thanhtien;
					?>
					<tr>
						<td><?=$i;?></td>
						<td><?=$row['proName'];?></td>
						<td><img src="admin/uploads/<?=$row['image'];?>" style="width: 100px; height: 100px;"/></td>
						<td><?php echo number_format($row['proPrice'])." VND";?></td>
						<td>
							<form action="" method="POST">
								<input type="hidden" name="idCart" value="<?=$row['idCart'];?>">
								<input type="number" name="quantity_item" value="<?=$row['quantity'];?>"/>
								<input type="submit" name="update" value="Update"/>
							</form>
						</td>
						<td><?php echo number_format($thanhtien)." VND";?></td>
						<td><a onclick="return confirm('Do yout want to delete this?')" href="?iddel=<?=$row['idCart'];?>">Xóa</a></td>
					</tr>
					<?php
							}
						}
					?>

				</table>
				<?php
					$check_cart = $cart->check_cart();
					if($check_cart->num_rows > 0){

				?>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td>
							<?php 
								$session->set("sum",$total);
								echo number_format($total)." VND";
							?>
						</td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>10%</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td><?php
							$vat = $total * 0.1;
							$grandTotal = $total + $vat;
							echo number_format($grandTotal)." VND";
						?></td>
					</tr>
				</table>
				<?php
					} else {
				?>
				<span class="failed">Your cart is empty! Please shopping now</span>
				<?php
					}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>  	
		<div class="clear"></div>
	</div>
</div>
<?
include "include/footer.php";
?>