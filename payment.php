<?php
	include "include/header.php";
?>
<?php
	if ($session->get("check_login") == false) {
		header("Location:login.php");
	}
?>
<?php 
	if (isset($_GET['action']) && $_GET['action'] == "order") {
		$id = $session->get("customer_id");
		$insert_order = $cart->insert_order($id);
		$cart->delete_all_item();
		header("Location:success.php");
	}
?>
<style type="text/css">
	.main .box_left{
		width: 50%;
		float: left;
		box-sizing: border-box;
		padding: 10px;
	}
	.main .box_right{
		width: 48%;
		float: right;
		box-sizing: border-box;
		padding: 10px;
	}
	.main .box_right a {
		display: block;
		color: #fff;
		width: 100px;
		padding: 10px;
		background: red;
		margin: 10px auto;
		text-align: center;
	}
	.main .btn_success{
		display: block;
		padding: 20px;
		width: 10%;
		background: green;
		text-align: center;
		color: #fff;
		border-radius: 20px;
		margin: 0 auto;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="box_left">
				<table class="tblone">
					<tr>
						<th width="10%">ID</th>
						<th width="20%">Product Name</th>
						<th width="20%">Price</th>
						<th width="15%">Quantity</th>
						<th width="20%">Total Price</th>
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
						<td><?php echo number_format($row['proPrice'])." VND";?></td>
						<td><?=$row['quantity'];?></td>
						<td><?php echo number_format($thanhtien)." VND";?></td>
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
				<table style="float:right;text-align:left;" width="50%">
					<tr>
						<th>Sub Total : </th>
						<td>
							<?php
								echo number_format($total)." VND";
							?>
						</td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>10% (<?= number_format($total*0.1)." VND";?>)</td>
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
		   <div class="box_right">
		   	<table class="tblone">
					<tr>
						<th colspan="2" >Thông tin khách hàng</th>						
					</tr>
					<?php
						$get_cus = $cus->get_customer($session->get("customer_id"));
						if($get_cus){
							while ($row = $get_cus->fetch_assoc()) {
							
					?>
					<tr>
						<td>Tên khách hàng</td>
						<td><?=$row['cusName'];?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?=$row['cusEmail'];?></td>
					</tr>
					<tr>
						<td>Địa chỉ</td>
						<td><?=$row['address'];?></td>
					</tr>
					<tr>
						<td>Tỉnh/Thành Phố</td>
						<td><?php
							$country_arr = array('HN' =>"Hà Nội" ,
							'HCM'=>"Hồ Chí Minh",
							'LA' => "Long An"
							 );
							foreach($country_arr as $key => $value){
								if($row['country'] == $key){
									echo $value;
								}
							}
						?></td>
					</tr>
					<tr>
						<td>Số điện thoại</td>
						<td><?=$row['phone'];?></td>
					</tr>
					<?php
							}
						}
					?>
				</table>
				<a href='editprofile.php?id=<?= $session->get("customer_id");?>'>Update</a>
		   </div>
    	</div>
		   <a href="?action=order" class="btn_success">Order Now</a>
 	</div>
</div>	
<?php
	include "include/footer.php";
?>