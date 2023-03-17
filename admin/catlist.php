<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/category.php";?>

<?php
	$id ="";
	if(isset($_GET['delid']) && $_GET['delid'] != NULL){
		$id = $_GET['delid'];
	}
	$category = new Category();

	$del_category = $category->delete_category($id);
	if($del_category){
		echo $del_category;
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
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
							$cate = $category->show_category();
							if($cate){
								$i = 0;
								while($row = $cate->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?= $i;?></td>
							<td><?= $row['catName'];?></td>
							<td><a href="catedit.php?idCate=<?=$row['idCategory'];?>">Edit</a> || <a  onclick="return confirm('Do you want to delete this?')" href="?delid=<?=$row['idCategory'];?>">Delete</a></td>
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

