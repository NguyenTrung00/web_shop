<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$get_order_pro = "";
	if(isset($_GET['idCus']) && $_GET['idCus'] != NULL){
		$idCus = $_GET['idCus'];
		$get_order_pro = $cart->getOrderProduct($idCus);
	}
?>

<?php
	if (isset($_GET['idOrder']) && isset($_GET['idCus']) ) {
		$idCus = $_GET['idCus'];
		$idOrder = $_GET['idOrder'];
		$price = $_GET['priceOrder'];
		$date = $_GET['orderDate'];

		$check_delivered = $cart->checkDeliver($idCus,$idOrder,$price,$date);
	}

	if(isset($_GET['idDel']) && $_GET['idDel'] != NULL){
		$idCus = $_GET['idCus'];
		$id = $_GET['idDel'];
		$price = $_GET['priceOrder'];
		$date = $_GET['orderDate'];

		$delOrder = $cart->delOrder($idCus,	$id,$price,$date);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Information of Cart</h2>
		<div class="block">        
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="10%">Id</th>
						<th width="15%">Product Name</th>
						<th width="15%">Price</th>
						<th width="15%">Quantity</th>
						<th width="15%">Total Price</th>
						<th width="15%">Order Date</th>
						<th width="20%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($get_order_pro){
							$i = 0;
							while($row = $get_order_pro->fetch_assoc()){
								$i++;
					?>
					<tr class="odd gradeX">
						<td><?=$i;?></td>
						<td><?=$row['proName'];?></td>
						<td><?=number_format($row['proPrice']). " VND";?></td>
						<td><?=$row['quantity'];?></td>
						<td><?=number_format($row['orderPrice']). " VND";?></td>
						<td><?=$row['orderDate'];?></td>
						<td>
							<?php
								if($row['status'] == 0){
							?>
								<a href="?idCus=<?=$row['idCustomer'];?>?&&idOrder=<?=$row['idOrder'];?>&&priceOrder=<?=$row['orderPrice'];?>&&orderDate=<?=$row['orderDate'];?>">Pending...</a>
							<?php
								} elseif($row['status'] == 1) {
									echo "Delivering...";
								} else {
							?>
								<a onclick="return confirm('Do you want to delete this?');" href="?idCus=<?=$row['idCustomer'];?>?&&idDel=<?=$row['idOrder'];?>&&priceOrder=<?=$row['orderPrice'];?>&&orderDate=<?=$row['orderDate'];?>">Delete</a>
							<?php		
								}
							?>
						</td>
					</tr>
					<?php
							}
						}
					?>
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
