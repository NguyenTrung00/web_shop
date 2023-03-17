<?php
include "include/header.php";
?>
<?php
	if($session->get("check_login") == false){
		header("Location:login.php");
	}
	$get_cus="";
	if(isset($_GET['id_cus']) && $_GET['id_cus'] != NULL){
		$id = $_GET['id_cus'];
		$get_cus = $cus->get_customer($id);
	}
?>
<style>
	.main .cartoption a {
		display: block;
		color: #fff;
		width: 100px;
/*		height: 30px;*/
		padding: 10px;
		background: red;
		margin: 10px auto;
		text-align: center;
	}
</style>
<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2>Profile</h2>
				<table class="tblone">
					<tr>
						<th colspan="2" ></th>						
					</tr>
					<?php
						if($get_cus){
							while ($row = $get_cus->fetch_assoc()) {
							
					?>
					<tr>
						<td>Tên khách hàng:</td>
						<td><?=$row['cusName'];?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$row['cusEmail'];?></td>
					</tr>
					<tr>
						<td>Địa chỉ:</td>
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
						<td>Số điện thoại:</td>
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
		<div class="clear"></div>
	</div>
</div>
<?php
include "include/footer.php";
?>