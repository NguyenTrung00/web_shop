<?php
	include "include/header.php";
	include "include/slider.php";
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$show_pro = $pro->getProFeature();
	      		if($show_pro){
	      			while($row = $show_pro->fetch_assoc()){
	      
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?idpro=<?=$row['idProduct'];?>"><img src="admin/uploads/<?=$row['image'];?>" alt="" /></a>
					 <h2><?=$row['proName'];?></h2>
					 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					 <p><span class="price"><?php echo number_format($row['proPrice'])." VND";?></span></p>
				     <div class="button"><span><a href="details.php?idpro=<?=$row['idProduct'];?>" class="details">Details</a></span></div>
				</div>
				<?php
						}
					}
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$get_new_pro = $pro->getProNew();
					if($get_new_pro){
						while($row_pro = $get_new_pro->fetch_assoc()){

				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?idpro=<?=$row_pro['idProduct'];?>"><img src="admin/uploads/<?=$row_pro['image'];?>" alt="" /></a>
					 <h2><?=$row_pro['proName'];?></h2>
					 <p><span class="price"><?php echo number_format($row_pro['proPrice'])." VND";?></span></p>
				     <div class="button"><span><a href="details.php?idpro=<?=$row_pro['idProduct'];?>" class="details">Details</a></span></div>
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

