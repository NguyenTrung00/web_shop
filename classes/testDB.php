<?php
	include "../lib/database.php";

	$db = new Database();
	$db->connectDB();
	$sql = "SELECT * FROM tbl_category ";
	
	$query = $db->select($sql);

	while($row = $query->fetch_array(MYSQLI_NUM)){

	echo "<pre>";
	print_r($row); 
	echo "</pre>";
	}
?>
