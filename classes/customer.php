<?php
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path."/../lib/database.php");
	include_once ($file_path."/../helpers/format.php");
	include_once ($file_path."/../lib/session.php");
?>

<?php
	class Customer{
		private $db;
		private $fm;
		private $session;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
			$this->session = new Session();
		}

		public function insert_customer($data){
			$cusName = $this->fm->validation($data['cusName']);
			$email = $this->fm->validation($data['cusEmail']);
			$address = $this->fm->validation($data['address']);
			$country = $this->fm->validation($data['country']);
			$phone = $this->fm->validation($data['phone']);
			$password = md5($this->fm->validation($data['password']));

			if(empty($cusName) || empty($email) || empty($address) ||empty($country) || empty($phone) ||empty($password)){
				$alert = "<span class='failed'>Fields are not empty!</span>";
				return $alert;
			} else {
				$check_email = "SELECT * FROM tbl_customer WHERE cusEmail='$email' LIMIT 1";
				$result_email = $this->db->select($check_email);
				$count = $result_email->num_rows;
				if($count > 0){
					$alert = "<span>This Email is existed.</span>";
					return $alert;
				} else {
					$sql = "INSERT INTO tbl_customer(cusName,cusEmail,address,country,phone,password) VALUES('".$cusName."','".$email."','".$address."','".$country."','".$phone."','".$password."')";
					$result = $this->db->insert($sql);
					if($result){
						$alert = "<span class='success'>Đăng ký thành công</span>";
					} else {
						$alert = "<span class='failed'>Đăng ký thất bại. Xin vui lòng nhập lại!</span>";
					}	
				}	return $alert;	
			}
		}

		public function login_customer($data){
			$email = $this->fm->validation($data['email_login']);
			$password = $this->fm->validation($data['password_login']);

			$email = $this->db->conn->real_escape_string($email);
			$password = md5($this->db->conn->real_escape_string($password));

			if(empty($email) || empty($password)){
				$alert = "<span class='failed'>Email Or Password must be not empty!</span>";
			} else {
				$check_login = "SELECT * FROM tbl_customer WHERE cusEmail='$email' AND password='$password'";
				$result = $this->db->select($check_login);
				$count = $result->num_rows;
				if($count > 0){
					$row = $result->fetch_assoc();
					$this->session->set('check_login',true);
					$this->session->set("customer_id",$row['idCustomer']);
					$this->session->set("customer_name",$row['cusName']);
					header("Location:index.php");
				} else {
					$alert = "<span class='failed'>Email and Password don't match!</span>";
					return $alert;
				}
			}
		}

		public function get_customer($id){
			$id = $this->db->conn->real_escape_string($id);
			$sql = "SELECT * FROM tbl_customer WHERE idCustomer='$id'";
			$result = $this->db->select($sql);
			return $result;
		}

		public function update_customer($data, $id){
			// $name = $this->fm->validation($data["cusName"]);
			// $email = $this->fm->validation($data["email"]);
			// $address = $this->fm->validation($data["address"]);
			// $country = $this->fm->validation($data["country"]);
			// $phone = $this->fm->validation($data["phone"]);

			$name = $this->db->conn->real_escape_string($data["cusName"]);
			$email = $this->db->conn->real_escape_string($data["cusEmail"]);
			$address = $this->db->conn->real_escape_string($data["address"]);
			$country = $this->db->conn->real_escape_string($data["country"]);
			$phone = $this->db->conn->real_escape_string($data["phone"]);
			$id = $this->db->conn->real_escape_string($id);

			if(empty($name) || empty($email) || empty($address) ||empty($country) || empty($phone) ){
				$alert = "<span class='failed'>Fields are not empty!</span>";
				return $alert;
			} else {
				$sql = "UPDATE tbl_customer SET cusName='$name',cusEmail='$email',address='$address',country='$country',phone='$phone' WHERE idCustomer='$id' ";
				$result = $this->db->insert($sql);
				if($result){
					$alert = "<span class='success'>Update thành công</span>";
				} else {
					$alert = "<span class='failed'>Update thất bại. Xin vui lòng nhập lại!</span>";
				}	
				return $alert;
			// echo $name."-".$email."-".$address."-".$country."-".$phone;
			}
		}
	}
?>