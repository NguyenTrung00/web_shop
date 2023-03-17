<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">        
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name Customer</th>
						<th>Email</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Order</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$get_order_cus = $cart->getOrderCustomer();
					if($get_order_cus){
						$i = 0;
						while ($row = $get_order_cus->fetch_assoc()) {
							$i++;
							?>
							<tr class="odd gradeX">
								<td><?=$i;?></td>
								<td><?=$row['cusName'];?></td>
								<td><?=$row['cusEmail'];?></td>
								<td><?=$row['address'];?></td>
								<td><?=$row['phone'];?></td>
								<td><a href="cartdetail.php?idCus=<?=$row['idCustomer'];?>">View Order</a></td>
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
