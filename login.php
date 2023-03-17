<?php
include "include/header.php";
// include "include/slider.php";
?>
<?php
	if($session->get("check_login")){
		header("Location:index.php");
	}
?>
<?php
	$insert_cus ="";
	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
		$insert_cus = $cus->insert_customer($_POST);
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
		$login = $cus->login_customer($_POST);
	}
?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<form action="" method="POST" id="member">
				<input type="text" name="email_login" class="field" placeholder="Enter your email...">
				<input type="password" name="password_login" class="field" placeholder="Enter password...">
				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
				<div class="buttons"><input class="grey" type="submit" value="Sign In" name="login"></div>
			</form>
		</div>
		<div class="register_account">
			<?php
				if($insert_cus){
					echo $insert_cus;
				}
			?>
			<h3>Register New Account</h3>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="cusName" placeholder="Name" >
								</div>
								<div>
									<input type="text" name="cusEmail" placeholder="Email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Address">
								</div>
								<div>
									<select id="country" name="country" class="frm-field required">
										<option value="null">Select a Country</option>         
										<option value="HCM">Hồ Chí Minh</option>
										<option value="HN">Hà Nội</option>
										<option value="LA">Long An</option>


									</select>
								</div>		        

								<div>
									<input type="text" name="phone" placeholder="Phone">
								</div>

								<div>
									<input type="text" name="password" placeholder="Password">
								</div>
							</td>
						</tr> 
					</tbody></table> 
					<div class="search"><input type="submit" name="submit" value="Create Account" class="grey"></input></div>
					<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
					<div class="clear"></div>
				</form>
			</div>  	
			<div class="clear"></div>
		</div>
	</div>
	<?php
	include "include/footer.php";
?>