<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/brand.php"?>

<?php $brand = new Brand(); ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand</h2>
        
        <div class="block copyblock"> 
        
           <form action="brandadd.php" method="post"> 
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['submit'])){
                    $brandName = $_POST['brandName'];
                    $insert_brand = $brand->insert_brand($brandName);

                    if($insert_brand){
                        echo $insert_brand;
                    }
                }
            }
        ?>
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="brandName" placeholder="Nhập thương hiệu sản phẩm" class="medium" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>
<?php include 'inc/footer.php';?>