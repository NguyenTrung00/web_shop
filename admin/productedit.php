<?php include_once "inc/header.php";?>
<?php include_once "inc/sidebar.php";?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once "../classes/product.php";?>

<?php
	$cat = new Category();
	$brand = new Brand();
    $pro = new Product();
    if(isset($_GET['action']) && $_GET['action'] == "edit"){
    	$id = $_GET['idpro'];
 		$getPro = $pro->getProductById($id);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])){
    	$update_pro = $pro->update_product($id,$_POST,$_FILES);
    	if($update_pro){
    		echo "<script>window.location='productlist.php'</script>";
    	}
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
         	<?php
         		if($getPro){
         			while($row = $getPro->fetch_assoc()){

         	?>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="product_name" value="<?=$row['proName'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>
                            <?php
                            	$show_cat = $cat->show_category();
                            	if($show_cat){
                            		while($row_cat = $show_cat->fetch_assoc()){
                            ?>
                            <option <?php echo ($row_cat['idCategory'] == $row['idCategory']) ? "selected":"";?> value="<?= $row['idCategory'];?>"><?= $row_cat['catName'];?></option> 
                            <?php			
                            		}
                            	}
                            ?>
                           
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Select Brand</option>
                            <?php
                            	$show_brand = $brand->show_brand();
                            	if($show_brand){
                            		while($row_brand = $show_brand->fetch_assoc()){
                            ?>
                            <option <?php echo ($row_brand['idBrand'] == $row['idBrand']) ? "selected" : "";?> value="<?=$row_brand['idBrand'];?>"><?=$row_brand['brandName'];?></option>
                            <?php		
                            		}
                            	}
                            ?>
                            
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="description"><?=$row['description'];?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="product_price" value="<?=$row['proPrice'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                    	<img src="uploads/<?=$row['image'];?>" style="display:block">
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="product_type">
                            <option >Select Type</option>
                            <?php
                            	if($row['type'] == 1){
                            ?>
                            <option selected value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                            <?php		
                            	}else {
                            ?>
                            <option value="1">Featured</option>
                            <option selected value="0">Non-Featured</option>
                            <?php
                            	}
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
                		}
                	}
                ?>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


