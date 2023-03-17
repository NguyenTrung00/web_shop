<?php
	include "include/header.php";
	// include "include/slider.php";
?>
<?php
	if(isset($_GET['idcate']) && $_GET['idcate'] != NULL){
		$id = $_GET['idcate'];
		$getAllpro = $pro->get_all_pro($id);
		$getCate = $cate->getCatById($id);

	}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Category: <?php
    			if($getCate){
    				$row_cate = $getCate->fetch_assoc();
    				echo $row_cate['catName'];
    			}
    		?> </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		if($getAllpro){
	      			while($row = $getAllpro->fetch_assoc()){

	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?idpro=<?=$row['idProduct'];?>"><img src="admin/uploads/<?=$row['image'];?>" alt="" /></a>
					 <h2><?=$row['proName'];?></h2>
					 <p><?php echo $fm->textShorten($row['description'],10);?></p>
					 <p><span class="price"><?php echo number_format($row['proPrice'])." VND";?></span></p>
				    <div class="button"><span><a href="details.php?idpro=<?=$row['idProduct'];?>" class="details">Details</a></span></div>
				</div>
				<?php
						}
					}
				?>
			</div>
    </div>
 </div>
<?php
	include "include/footer.php";
?>