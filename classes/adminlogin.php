<?php
	include_once "../lib/session.php";
	$session = new Session();
	$session->checkLogin();
	// $session->checkSession();

	include "../lib/database.php";
	include "../helpers/format.php";
?>
<?php
	class Adminlogin {
		private $db;
		private $fm;
		private $sess;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
			$this->sess = new Session();
		}

		public function login_admin($name, $password){
			$name = $this->fm->validation($name);
			$password = $this->fm->validation($password);


			$name = $this->db->conn->real_escape_string($name);
			$password = $this->db->conn->real_escape_string($password);

			if(empty($name) || empty($password)) {
				$alert = "User and Pass must be not empty";
				return $alert;
			} else {
				$sql = "SELECT * FROM tbl_admin WHERE adminUser='".$name."' AND adminPass='".$password."' LIMIT 1";
				$result = $this->db->select($sql);

				if($result != false){
					$value = $result->fetch_assoc();
					$this->sess->set('adminlogin',true);
					$this->sess->set('adminID',$value['id_admin']);
					$this->sess->set("adminUser",$value['adminUser']);
					$this->sess->set("adminName",$value['adminName']);
					header("Location:index.php");
				} else {
					$alert = "Username and Pass not match";
					return $alert;
				}
			}
		}
	}
?>