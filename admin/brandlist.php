<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/brand.php";?>

<?php
	$brand = new Brand();
	$brand_list = $brand->show_brand();
?>
<?php
	
?>  
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block"> 
		<?php
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$del_brand = $brand->delete_brand($id);
				if($del_brand){
					echo $del_brand;
				}
			}
		?>     
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($brand_list){
						$i = 0;
						while($row = $brand_list->fetch_assoc()){
							$i++;
							?>
							<tr class="odd gradeX">
								<td><?= $i;?></td>
								<td><?= $row['brandName'];?></td>
								<td><a href="brandedit.php?idbrand=<?=$row['idBrand'];?>">Edit</a> || <a  onclick="return confirm('Are you want to delete this?')" href="?id=<?=$row['idBrand'];?>">Delete</a></td>
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

