<?php
include "include/header.php";
?>
<?php
	$nameSearch = "";
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search'])){
		$nameSearch = $_POST['nameSearch'];
		$searchPro = $pro->searchProduct($nameSearch);
	}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<h3>Tìm kiếm: <?=$nameSearch;?></h3>
			<?php
				if($searchPro){
					while ($row = $searchPro->fetch_assoc()) {
						
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?idpro=<?=$row['idProduct'];?>"><img src="admin/uploads/<?=$row['image'];?>" alt="" /></a>
				<h2><?=$row['proName'];?></h2>
				<p><?= $fm->textShorten($row['description'], 10);?></p>
				<p><span class="price"><?= $row['proPrice'];?></span></p>
				<div class="button"><a href="details.php?idpro=<?=$row['idProduct'];?>" class="details">Details</a></div>
			</div>
			<?php
					}
				} elseif($searchPro == ""){
					echo $searchPro;	
				}
			?>
		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>