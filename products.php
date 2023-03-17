<?php
include "include/header.php";
// include "include/slider.php";
?>
<?php
	$show_cate = $cate->show_category();
?>

<style>
	.main .page_list{
		
		height: auto;
		margin: 20px auto ;
		text-align: center;
	}
	.main .page_list .page_item{
		display: inline-block;
		padding: 10px 20px;
		border: 1px solid #333;
		border-radius: 15px;
	}
</style>

<div class="main">
	<div class="content">
		<?php
			if($show_cate){
				while($row_cate = $show_cate->fetch_assoc()){

		?>
		<div class="content_top">
			<div class="heading">
				<h3>Latest from <?=$row_cate['catName'];?></h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
				$show_pro = $pro->getAllProduct();
				if($show_pro){
					while($row_pro = $show_pro->fetch_assoc()) {
						if($row_pro['idCategory'] == $row_cate['idCategory']){
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?idpro=<?=$row_pro['idProduct'];?>"><img src="admin/uploads/<?=$row_pro['image'];?>" alt="" /></a>
				<h2><?=$row_pro['proName'];?></h2>
				<p><?=$fm->textShorten($row_pro['description'], 10);?></p>
				<p><span class="price"><?= number_format($row_pro['proPrice'])." VND";?></span></p>
				<div class="button"><a href="details.php?idpro=<?=$row_pro['idProduct'];?>" class="details">Details</a></div>
			</div>
			<?php
						}
					}
				}
			?>
			
			
		</div>
		<?php
				}
			}
		?>
	</div>
</div>
<?php
include "include/footer.php";
?>