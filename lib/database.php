<?php
	$file_path = realpath(dirname(__FILE__));
 	include_once ($file_path."/../config/config.php");
?>
<?php
	class Database {
		private $host = DB_HOST;
		public $user = DB_USER;
		public $pass = DB_PASS;
		public $dbname = DB_NAME;

		public $conn;
		public $err;

		public function __construct(){
			$this->connectDB();
		}

		public function connectDB(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

			if($this->conn->connect_error){
				$this->err = "Connect Failed..." . $this->conn->connect_error;
				return false;
			}
		}

		//select and read database
		public function select($sql){
			$result = $this->conn->query($sql);

			if($result){
				return $result;
			} else {
				return false;
			}
		}

		//insert database
		public function insert($sql) {
			$result = $this->conn->query($sql) or ($this->conn->err.__LINE__);

			if($result) {
				return $result;
			} else {
				return false;
			}
		}

		//update database
		public function update($sql) {
			$result = $this->conn->query($sql) ;

			if($result) {
				return $result;
			} else {
				return false;
			}
		}

		//delete database
		public function delete($sql){
			$result = $this->conn->query($sql) or ($this->conn->err.__LINE__);

			if($result) {
				return $result;
			} else {
				return false;
			}
		}
	}
?>