<?php $file_path = realpath(dirname(__FILE__));?>
<?php include_once ($file_path."/../lib/database.php");?>
<?php include_once ($file_path."/../helpers/format.php");?>

<?php
	class Product {
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_product($data,$files){
			$pro_name = $this->db->conn->real_escape_string($data["product_name"]);
			$id_cate = $this->db->conn->real_escape_string($data["category"]);
			$id_brand = $this->db->conn->real_escape_string($data["brand"]);
			$pro_price = $this->db->conn->real_escape_string($data["product_price"]);
			$description = $this->db->conn->real_escape_string($data["description"]);
			$type = $this->db->conn->real_escape_string($data["product_type"]);

			$image_permited = array('jpg', 'jpeg','png','gif');
			$file_name = $files['upload']['name'];
			$file_tmp = $files['upload']['tmp_name'];
			$file_size = $files['upload']['size'];
			$div = explode('.',$file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()),0,10) .".".$file_ext;

			if($pro_name == "" || $id_cate == "" || $id_brand == "" || $pro_price == "" || $description == "" || 
				$type == "" || $unique_image == ""){
				$alert = "<span>Fields must be not empty.</span>";
			} else {
				move_uploaded_file($file_tmp, "uploads/".$unique_image);
				$sql = "INSERT INTO tbl_product(proName,idCategory,idBrand,proPrice,image,description,type) VALUES('".$pro_name."','".$id_cate."','".$id_brand."','".$pro_price."','".$unique_image."','".$description."','".$type."')";
				$result = $this->db->insert($sql);
				if($result){
					$alert = "<span>Insert Successfully.</span>";
				} else {
					$alert = "<span>Insert Failed</span>";
				}
			}

			return $alert;
		}

		public function show_product(){
			$sql = "SELECT pro.*,cat.catName,brand.brandName FROM tbl_product as pro INNER JOIN tbl_category as cat ON pro.idCategory = cat.idCategory INNER JOIN tbl_brand as brand ON pro.idBrand = brand.idBrand ORDER BY pro.idProduct DESC ";
			// $sql = "SELECT * FROM tbl_product ORDER BY idProduct DESC";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getProductById($id){
			$sql = "SELECT * FROM tbl_product WHERE idProduct='$id' LIMIT 1";
			$result = $this->db->select($sql);
			return $result;
		}

		public function update_product($id,$data,$files){
			$id = $this->db->conn->real_escape_string($id);
			$pro_name = $this->db->conn->real_escape_string($data["product_name"]);
			$id_cate = $this->db->conn->real_escape_string($data["category"]);
			$id_brand = $this->db->conn->real_escape_string($data["brand"]);
			$pro_price = $this->db->conn->real_escape_string($data["product_price"]);
			$description = $this->db->conn->real_escape_string($data["description"]);
			$type = $this->db->conn->real_escape_string($data["product_type"]);

			// check image and get image
			if(!empty($files['image']['name'])){
				$image_permited = array('jpg', 'jpeg','png','gif');
				$file_name = $files['image']['name'];
				$file_tmp = $files['image']['tmp_name'];
				$file_size = $files['image']['size'];
				$div = explode('.',$file_name);
				$file_ext = strtolower(end($div));
				$unique_image = substr(md5(time()),0,10) .".".$file_ext;

				if($file_size >  1048576){
					$alert = "<span>Image size should get less than 1MB!</span>";
					return $alert;
				}
				// if(in_array($file_ext,$image_permited) === false){
				// 	$alert = "<span>Image does not include!</span>";
				// 	return $alert;
				// }

				$sql = "SELECT * FROM tbl_product WHERE idProduct='$id'";
				$result = $this->db->select($sql);
				while($row = $result->fetch_assoc()){
					unlink("uploads/".$row['image']);
				}

				move_uploaded_file($file_tmp,"uploads/".$unique_image);
				$sql_update = "UPDATE tbl_product SET proName='$pro_name',idCategory='$id_cate',idBrand='$id_brand',
				proPrice='$pro_price',image='$unique_image',description='$description',type='$type' WHERE idProduct='$id'";
			} else {
				$sql_update = "UPDATE tbl_product SET proName='$pro_name',idCategory='$id_cate',idBrand='$id_brand',
				proPrice='$pro_price',description='$description',type='$type' WHERE idProduct='$id' ";
			}

			$result = $this->db->update($sql_update);
			if($result){
				$alert = "<span>Update Successfully.</span>";
			} else {
				$alert = "<span>Update Failed.</span>";
			}
			return $alert;
		}

		public function delete_product($id){
			$sql_select = "SELECT image FROM tbl_product WHERE idProduct='$id'";
			$query = $this->db->select($sql_select);
			while($row = $query->fetch_assoc()){
				unlink("uploads/".$row['image']);
			}

			$sql = "DELETE FROM tbl_product WHERE idProduct='$id'";
			$result = $this->db->delete($sql);
			if($result){
				$alert = "<span>Delete Successfully.</span>";
			} else {
				$alert = "<span>Delete Failed.<span>";
			}
			return $alert;
		}
		// end admin mangement section

		// frontend section
		public function getProFeature(){
			$sql = "SELECT * FROM tbl_product WHERE type = 1 LIMIT 4";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getProNew(){
			$sql = "SELECT * FROM tbl_product ORDER BY idProduct DESC LIMIT 4";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getProduct($id){
			$sql = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.idCategory = tbl_category.idCategory INNER JOIN tbl_brand ON tbl_product.idBrand = tbl_brand.idBrand WHERE tbl_product.idProduct ='$id'";
			$result = $this->db->select($sql);
			return $result;
		}
		// End admin section
		// front-end section

		public function getProApp(){
			$sql = "SELECT tbl_brand.brandName, tbl_product.* FROM tbl_product INNER JOIN tbl_brand ON tbl_product.idBrand = tbl_brand.idBrand WHERE tbl_product.idBrand = 2 ORDER BY tbl_product.idProduct DESC LIMIT 1";
			$result = $this->db->select($sql);
			if($result){
				echo "Thanh cong";
			} else {
				echo "That bai";
			}
		}

		public function get_lasted_apple(){
			$sql = "SELECT * FROM tbl_product WHERE idBrand='2' ORDER BY idProduct DESC LIMIT 1";
			$result = $this->db->select($sql);
			return $result;
		}
		public function get_lasted_samsung(){
			$sql = "SELECT * FROM tbl_product WHERE idBrand='11' ORDER BY idProduct DESC LIMIT 1";
			$result = $this->db->select($sql);
			return $result;
		}
		public function get_lasted_huawei(){
			$sql = "SELECT * FROM tbl_product WHERE idBrand='8' ORDER BY idProduct DESC LIMIT 1";
			$result = $this->db->select($sql);
			return $result;
		}
		public function get_lasted_house(){
			$sql = "SELECT * FROM tbl_product WHERE idCategory='10' ORDER BY idProduct DESC LIMIT 1";
			$result = $this->db->select($sql);
			return $result;
		}

		public function get_all_pro($id){
			$id = $this->db->conn->real_escape_string($id);
			$sql = "SELECT * FROM tbl_product WHERE idCategory='$id' ORDER BY idProduct DESC";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getAllProduct(){
			$sql = "SELECT * FROM tbl_product, tbl_category WHERE tbl_product.idCategory = tbl_category.idCategory";
			$result = $this->db->select($sql);
			return $result;
		}

		public function searchProduct($name){
			$name = $this->fm->validation($name);
			$name = $this->db->conn->real_escape_string($name);

			if(!empty($name)){
				$sql = "SELECT * FROM tbl_product WHERE proName LIKE '%$name%' OR description LIKE '%$name%'";
				$result = $this->db->select($sql);

				return $result;
			} else {
				$alert = "<span class='failed'>Field must be not empty.</span>";
				return $alert;
			}
		}
	}
?>