<?php $file_path = realpath(dirname(__FILE__));?>
<?php include_once ($file_path."/../lib/database.php");?>
<?php include_once ($file_path."/../lib/session.php");?>
<?php include_once ($file_path."/../helpers/format.php");?>
<?php
	class Cart{
		private $db;
		private $fm;
		private $session;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
			$this->session = new Session();
		}

		public function addToCart($id, $quantity){
			$quantity = $this->fm->validation($quantity);
			$quantity = $this->db->conn->real_escape_string($quantity);
			$id = $this->db->conn->real_escape_string($id);
			$id_session = session_id();

			// Kiểm tra sản phẩm có tồn tại trong giỏ hàng không?

			$sql_select = "SELECT * FROM tbl_product WHERE idProduct = '$id'";
			$result = $this->db->select($sql_select)->fetch_assoc();
			
			$pro_name = $result['proName'];
			$pro_price = $result['proPrice'];
			$image = $result['image'];

			$check_cart = "SELECT * FROM tbl_cart WHERE idProduct='$id' AND idSession='$id_session'";
			$query = $this->db->select($check_cart);
			$count = $query->num_rows;
			if($count > 0){
				$msg = "<span class='failed'>Product already added.</span>";
				return $msg;
			} else {
				$sql_insert = "INSERT INTO tbl_cart(idProduct,idSession,proName,proPrice,quantity,image) 
					VALUES('$id','$id_session','$pro_name','$pro_price','$quantity','$image')";
				$result = $this->db->insert($sql_insert);
				if($result){
					header("Location:cart.php");
				} else {
					echo "That bai";
				}
			}
			
		}

		public function show_cart(){
			$id_session = session_id();
			$sql = "SELECT * FROM tbl_cart WHERE idSession='$id_session'";
			$result = $this->db->select($sql);
			return $result;
		}

		public function update_quantity_cart($id, $quantity){
			$quantity = $this->fm->validation($quantity);
			$quantity = $this->db->conn->real_escape_string($quantity);
			$id = $this->db->conn->real_escape_string($id);

			$sql = "UPDATE tbl_cart SET quantity='$quantity' WHERE idCart='$id'";
			$result = $this->db->update($sql);
			if($result){
				header("Location:cart.php");
			} else {
				echo "That bai";
			}
		}

		public function delete_item_cart($id){
			$id = $this->db->conn->real_escape_string($id);

			$sql = "DELETE FROM tbl_cart WHERE idCart='$id'";
			$result = $this->db->delete($sql);
			if($result){
				$alert = "<span class='success'>Delete Item Successfully.</span>";
			} else {
				$alert = "<span class='failed'>Delete Item Failed.</span>";
			}
			return $alert;
		}

		public function check_cart(){
			$id = session_id();
			$sql = "SELECT * FROM tbl_cart WHERE idSession='$id'";
			$result = $this->db->select($sql);
			return $result;
		}

		public function delete_all_item(){
			$session_id = session_id();	
			$sql = "DELETE FROM tbl_cart WHERE idSession='$session_id'";
			$result = $this->db->delete($sql);
			if($result){
				echo "Thanh cong";
			} else {
				echo "That bai";
			}
		}

		public function insert_order($id){
			$id_session = session_id();
			$sql = "SELECT * FROM tbl_cart WHERE idSession='$id_session'";
			$query_sel = $this->db->select($sql);
			if($query_sel){
				while($row = $query_sel->fetch_assoc()){
					$idCus = $id;
					$idPro = $row['idProduct'];
					$proName = $row['proName'];
					$quantity = $row['quantity'];
					$price = $row['proPrice'] * $quantity;
					$image = $row['image'];

					$sql_ins = "INSERT INTO tbl_order(idCustomer,idProduct,proName,quantity,orderPrice,image,status) 
					VALUES('$idCus','$idPro','$proName','$quantity','$price','$image',0)";
					$resut = $this->db->insert($sql_ins);
				}
			}
		}

		public function get_order($id){
			$id = $this->db->conn->real_escape_string($id);
			$sql = "SELECT * FROM tbl_order WHERE idCustomer='$id'";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getOrderCustomer(){
			$sql = "SELECT cs.phone, cs.cusName, cs.address, cs.cusEmail, od.idCustomer,od.orderDate FROM tbl_customer AS cs INNER JOIN tbl_order as od ON cs.idCustomer = od.idCustomer GROUP BY od.idCustomer ORDER BY od.idCustomer DESC";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getOrderProduct($id){
			$id = $this->db->conn->real_escape_string($id);
			$sql = "SELECT pro.proName,pro.proPrice, od.idOrder, od.idCustomer,od.quantity, od.orderPrice, od.orderDate, od.status FROM tbl_order AS od INNER JOIN tbl_product AS pro ON od.idProduct = pro.idProduct WHERE od.idCustomer = '$id' ORDER BY od.idProduct DESC";
			$result = $this->db->select($sql);
			return $result;
		}

		public function checkDeliver($idCus,$id,$price,$date){
			$idCus = $this->db->conn->real_escape_string($idCus);
			$idOrder = $this->db->conn->real_escape_string($id);
			$price = $this->db->conn->real_escape_string($price);
			$date = $this->db->conn->real_escape_string($date);

			if(empty($id) || empty($price) || empty($date)){
				$alert = "<span class='failed'>Fields must be not empty!</span>";
				return $alert;
			} else {
				$sql = "UPDATE tbl_order SET status=1 WHERE idOrder ='$idOrder' AND orderPrice='$price' AND orderDate='$date'";
				$result = $this->db->update($sql);
				if($result){
					echo  "<script>window.location='cartdetail.php?idCus=".$idCus."'</script>";
					// header("Location:cartdetail.php?idCus=$idCus");
				} else {
					$alert = "<span class='failed'>Update failed!</span>";
					return $alert;	
				}
			}
		}

		public function confirmOrder($id,$price,$date){
			$id = $this->db->conn->real_escape_string($id);
			$price = $this->db->conn->real_escape_string($price);
			$date = $this->db->conn->real_escape_string($date);

			if(empty($id) || empty($price) || empty($date)){
				$alert = "<span class='failed'>Fields must be not empty!</span>";
				return $alert;
			} else {
				$sql = "UPDATE tbl_order SET status=2 WHERE idOrder ='$id' AND orderPrice='$price' AND orderDate='$date'";
				$result = $this->db->update($sql);
				if($result){
					header("Location:orderdetail.php");
				} else {
					$alert = "<span class='failed'>Update failed!</span>";
					return $alert;	
				}
			}
		}
		public function delOrder($idCus,$id,$price,$date){
			$id = $this->db->conn->real_escape_string($id);
			$price = $this->db->conn->real_escape_string($price);
			$date = $this->db->conn->real_escape_string($date);

			$sql = "DELETE FROM tbl_order WHERE idOrder ='$id' AND orderPrice='$price' AND orderDate='$date'";
			$result = $this->db->delete($sql);
			if($result){
				echo  "<script>window.location='cartdetail.php?idCus=".$idCus."'</script>";
			} else {
				$alert = "<span class='failed'>Update failed!</span>";
				return $alert;	
			}
		}
	}
?>