<?php
include "include/header.php";
?>
<?php
if ($session->get("check_login") == false) {
	header("Location:login.php");
}
?>
<?php
	$id = $session->get("customer_id");
	$get_order = $cart->get_order($id);
	$total_price = 0;
	if($get_order){
		while ($row = $get_order->fetch_assoc()) {
			$price = $row['orderPrice'];
			$total_price += $price;
		}
	}
?>
<style>
	.main h2{
		color: green;
		text-align: center;
		font-size: 40px;
	}	
	.main p {
		font-size: 20px;
		padding: 0 30px;
		margin-top: 10px;
	}
	.main a{
		font-size: 18px;
	}
	.main a:hover {
		color: red;
		text-decoration: underline;
	}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<h2>Đặt hàng thành công</h2>
			<p class="price">Tổng giá tiền: <?= number_format($total_price)." VND";?> </p>
			<p class="info">Cảm ơn bạn tin tưởng và đặt hàng tại cửa hàng chúng tôi. Chúng tôi sẽ liên hệ bạn sớm nhất. Bạn có thể xem chi tiết các sản phẩm đã mua <a href="orderdetail.php">tại đây</a></p>
		</div>
	</div>
</div>	
<?php
include "include/footer.php";
?>