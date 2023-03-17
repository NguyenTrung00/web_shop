<?php
include "include/header.php";
?>
<?php
	if($session->get("check_login") == false){
		header("Location:login.php");
	}
	$get_cus="";
	if(isset($_GET['id']) && $_GET['id'] != NULL){
		$id = $_GET['id'];
		$get_cus = $cus->get_customer($id);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save'])){
		$update_cus = $cus->update_customer($_POST, $id);
		if($update_cus){
			header("Location:profile.php?id_cus=".$session->get("customer_id"));
		}
	}
?>
<style>
	.main .cartoption .save {
		display: block;
		color: #fff;
		width: 100px;
/*		height: 30px;*/
		padding: 10px;
		background: green;
		margin: 10px auto;
		text-align: center;
		cursor: pointer;
	}
</style>
<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2>Profile</h2>
				<form action="" method="POST">
					<table class="tblone">
						<tr>
							<th colspan="2"></th>
						</tr>
						<?php
							if($get_cus){
								while ($row = $get_cus->fetch_assoc()) {
						?>
						<tr>
							<td>Tên khách hàng:</td>
							<td><input type="text" name="cusName" value="<?=$row['cusName'];?>"></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" name="cusEmail" value="<?=$row['cusEmail'];?>"></td>
						</tr>
						<tr>
							<td>Địa chỉ:</td>
							<td><input type="text" name="address" value="<?=$row['address'];?>"></td>
						</tr>
						<tr>
							<td>Tỉnh/Thành Phố</td>
							<td>
								<select name="country" >
								<?php
									$country_arr = array('HN' =>"Ha Noi" ,
									'HCM'=>"Ho Chi Minh",
									'LA' => "Long An"
									 );
									foreach($country_arr as $key => $value){
										if($row['country'] == $key){
								
								?>
									<option value="<?= $key?>"><?=$value?></option>
								<?php
										}
									}
									?>
									<option value="HCM">Hồ Chí Minh</option>
									<option value="HN">Hà Nội</option>
									<option value="LA">Long An</option>
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Số điện thoại:</td>
							<td><input type="text" name="phone" value="<?=$row['phone'];?>"></td>
						</tr>
						<?php
								}
							}
						?>
					</table>
					<input type="submit" value="Save" name="save" class="save">
				</form>			

			</div>
			
		</div>  	
		<div class="clear"></div>
	</div>
</div>
<?php
include "include/footer.php";
?>