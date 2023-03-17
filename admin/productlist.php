<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once "../classes/product.php";?>

<?php
	$product = new Product();
	$show_pro = $product->show_product();

	if(isset($_GET['iddel']) && $_GET['iddel'] != NULL){
		$id = $_GET['iddel'];
		$delete_pro = $product->delete_product($id);
		if($delete_pro){
			echo "<script>window.location='productlist.php'</script>";
		}
	}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example" style="text-align: center;">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên sản phẩm</th>
					<th>Hình ảnh</th>
					<th>Danh mục</th>
					<th>Hãng</th>
					<th>Giá sản phẩm</th>
					<th>Nôi dung</th>
					<th>Thể loại</th>
					<th>Quản lí</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($show_pro){
						$i = 0;
						while($row = $show_pro->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?= $i;?></td>
					<td><?= $row['proName'];?></td>
					<td>
						<img src="uploads/<?=$row['image'];?>" style="width:100px; height:100px">
					</td>
					<td><?=$row['catName'];?></td>
					<td><?=$row['brandName'];?></td>
					<td><?php echo number_format($row['proPrice'])." VND";?></td>
					<td><?=$row['description'];?></td>
					<td>
						<?php
							if($row['type'] == 1){
								echo "Featured";
							} else {
								echo "Not Featured";
							}
						?>
					</td>	
					<td><a href="productedit.php?action=edit&&idpro=<?=$row['idProduct'];?>">Edit</a> || 
						<a onclick="return confirm('Do you want to delete this?');" href="?iddel=<?=$row['idProduct'];?>">Delete</a></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
