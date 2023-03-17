<?php $file_path = realpath(dirname(__FILE__));?>
<?php include_once ($file_path."/../lib/database.php");?>
<?php include_once ($file_path."/../helpers/format.php");?>
<?php
	class Brand{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($name){
			$name = $this->fm->validation($name);
			$name = $this->db->conn->real_escape_string($name);

			if(empty($name)){
				$alert= "<span class='failed'>Brand name must be not empty</span>";
				return $alert;
			} else {
				$sql = "INSERT INTO tbl_brand(brandName) VALUES('$name')";
				$result = $this->db->insert($sql);

				if($result){
					$alert= "<span class='success'>Insert brand name successfully</span>";
				} else {
					$alert= "<span class='falied'>Insert not success</span>";
				}

				return $alert;
			}
		}

		public function show_brand(){
			$sql = "SELECT * FROM tbl_brand ORDER BY idBrand ASC";
			$result = $this->db->select($sql);

			return $result;
		}

		public function getBrandById($id){
			$sql = "SELECT * FROM tbl_brand WHERE idBrand='$id' LIMIT 1";
			$result = $this->db->select($sql);
			return $result;
		}

		public function update_brand($id, $name){
			$name = $this->fm->validation($name);

			$name = $this->db->conn->real_escape_string($name);
			$id = $this->db->conn->real_escape_string($id);

			if(empty($name)){
				$alert = "<span class='failed'>Brand name must be not empty</span>";
				return $alert;
			} else {
				$sql = "UPDATE tbl_brand SET brandName='$name' WHERE idBrand='$id'";
				$result = $this->db->update($sql);

				if($result){
					$alert = "<span class='success'>Update seccessfully</span>";
				} else {
					$alert = "<span class='failed'>Update not success</span>";
				}

				return $alert;
			}
		}

		public function delete_brand($id){
			$id = $this->db->conn->real_escape_string($id);
			$sql = "DELETE FROM tbl_brand WHERE idBrand='$id'";
			$result = $this->db->delete($sql);
			if($result){
				$alert = "<span class='success'>Delete successfully</span>";
			} else {
				$alert = "<span class='failed'>Delete not success</span>";
			}

			return $alert;
		}
	}
?>