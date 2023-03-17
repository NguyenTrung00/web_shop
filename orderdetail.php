<?php
include "include/header.php";
?>
<?php
if ($session->get("check_login") == false) {
	header("Location:login.php");
}
?>
<?php
	if(isset($_GET['idOrder']) && $_GET['idOrder'] != NULL){
		$id = $_GET['idOrder'];
		$price = $_GET['priceOrder'];
		$date = $_GET['orderDate'];

		$confirmOrder = $cart->confirmOrder($id,$price,$date);
	}
?>
<style>
	.main .cartpage .title{
		width: 200px;
	}
</style>
<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2 class="title">Order detail</h2>
				<table class="tblone">
					<tr>
						<th width="10%">ID</th>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Quantity</th>
						<th width="20%">Order Date</th>
						<th width="15%">Status</th>
						<th></th>
						
					</tr>
					<?php
					$get_order = $cart->get_order($session->get("customer_id"));
					if($get_order){
						$i=0;
						while($row = $get_order->fetch_assoc()){
							$i++;
							?>
							<tr>
								<td><?=$i;?></td>
								<td><?=$row['proName'];?></td>
								<td><img src="admin/uploads/<?=$row['image'];?>" style="width: 100px; height: 100px;"/></td>
								<td><?php echo number_format($row['orderPrice'])." VND";?></td>
								<td><?=$row['quantity'];?></td>
								<td><?= $fm->formatDate($row['orderDate']);?></td>
								<td>
									<?php
									if($row['status'] == 0){
										echo "Pending...";
									} elseif($row['status'] == 1) {
										echo "Delivering..";
									} else {
										echo "Received";
									}
									?>
								</td>	
								<td>
									<?php
										if($row['status'] == 0){
											echo "N/A";
										}elseif($row['status'] == 1){
									?>
									<a href="?idOrder=<?=$row['idOrder'];?>&&priceOrder=<?=$row['orderPrice'];?>&&orderDate=<?=$row['orderDate'];?>">Confirm</a>
									<?php		
										} else {
									
										echo "";
											
										}
									?>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>

			</div>
		</div>  	
		<div class="clear"></div>
	</div>
</div>	
<?php
include "include/footer.php";
?>