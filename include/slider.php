<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastedApple = $pro->get_lasted_apple();
					if($getLastedApple){
						while ($row_app = $getLastedApple->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?=$row_app['image'];?>" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?=$row_app['proName'];?></h2>
						<p><?php echo $fm->textShorten($row_app['description'], 10);?></p>
						<div class="button"><span><a href="details.php?idpro=<?=$row_app['idProduct'];?>">Add to cart</a></span></div>
				   </div>
			   	</div>		
			  	<?php
			  			}
			  		}
			  	?>

			  	<?php
					$getLastedSamsung = $pro->get_lasted_samsung();
					if($getLastedSamsung){
						while ($row_ss = $getLastedSamsung->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?=$row_ss['image'];?>" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?=$row_ss['proName'];?></h2>
						<p><?php echo $fm->textShorten($row_ss['description'], 10);?></p>
						<div class="button"><span><a href="details.php?idpro=<?=$row_ss['idProduct'];?>">Add to cart</a></span></div>
				   </div>
			   	</div>
				<?php
						}
					}
				?>
			</div>
			<div class="section group">
				<?php
					$getLastedHuawei = $pro->get_lasted_huawei();
					if($getLastedHuawei){
						while ($row_hw = $getLastedHuawei->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?=$row_hw['image'];?>" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?=$row_hw['proName'];?></h2>
						<p><?php echo $fm->textShorten($row_hw['description'], 10);?></p>
						<div class="button"><span><a href="details.php?idpro=<?=$row_hw['idProduct'];?>">Add to cart</a></span></div>
				   </div>
			   	</div>
				<?php
						}
					}
				?>
			   <?php
					$getLastedHouse = $pro->get_lasted_house();
					if($getLastedHouse){
						while ($row_house = $getLastedHouse->fetch_assoc()) {
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?=$row_house['image'];?>" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?=$row_house['proName'];?></h2>
						<p><?php echo $fm->textShorten($row_house['description'], 10);?></p>
						<div class="button"><span><a href="details.php?idpro=<?=$row_house['idProduct'];?>">Add to cart</a></span></div>
				   </div>
			   	</div>
				<?php
						}
					}
				?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	