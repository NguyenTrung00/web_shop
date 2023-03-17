<?php
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path."/../lib/database.php");
	include_once ($file_path."/../helpers/format.php");
?>

<?php
	class Category {
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_category($catName){
			$catName = $this->fm->validation($catName);

			$catName = $this->db->conn->real_escape_string($catName);

			if($catName == ""){
				$alert = "<span class='failed'>Category name must be not empty</span>";
				return $alert;
			} else {
				$sql = "INSERT INTO tbl_category(catName) VALUES('".$catName."')";
				$result = $this->db->insert($sql);

				if($result){
					$alert = "<span class='success'>Insert category successfully</span>";
				} else {
					$alert = "<span class='failed'>Insert category not successful</span>";
				}

				return $alert;
			}
		}

		public function show_category(){
			$sql = "SELECT * FROM tbl_category ORDER BY idCategory ASC";
			$result = $this->db->select($sql);

			return $result;
		}

		public function getCatById($id){
			$sql = "SELECT * FROM tbl_category WHERE idCategory='$id'";
			$result = $this->db->select($sql);

			return $result;
		}

		public function update_category($id, $cateName){
			$catName = $this->fm->validation($cateName);
			$id = $this->fm->validation($id);

			$catName = $this->db->conn->real_escape_string($catName);
			$id = $this->db->conn->real_escape_string($id);

			if(empty($catName)){
				echo "<span class='failed'>Categoy name must be not empty</span>";
			} else {
				$sql = "UPDATE tbl_category SET catName='$catName' WHERE idCategory='$id'";
				$result = $this->db->update($sql);

				if($result){
					echo "<span class='success'>Update category name successfully</span>";
				} else {
					echo "<span class='failed'>Update category name not successful</span>";
				}
			}
		}

		public function delete_category($id){
			$id = $this->fm->validation($id);
			$id = $this->db->conn->real_escape_string($id);

			$sql = "DELETE FROM tbl_category WHERE idCategory='$id'";
			$result = $this->db->delete($sql);

			if($result) {
				echo "<span class='success'>Delete successfully</span>";
			} else {
				echo "Delete failed";
			}
		}
	}
?>