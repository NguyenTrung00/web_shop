﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/category.php"?>

<?php
    $category = new Category();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            $catName = $_POST['catName'];
        }
        $insert_cat = $category->insert_category($catName);
    }

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
        <?php
            if(isset($insert_cat)){
                echo $insert_cat;
            }
        ?>
           <form action="catadd.php" method="post"> 
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="catName" placeholder="Nhập danh mục sản phẩm" class="medium" />
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