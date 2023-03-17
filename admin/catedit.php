<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/category.php"?>

<?php
if(!isset($_GET['idCate']) || $_GET['idCate'] == NULL){
    echo "<script>window.location='catlist.php'</script>";
} else {
    $idCate = $_GET['idCate'];
}

$category = new Category();



?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
         <form action="" method="post"> 
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['update'])){
                    $catName = $_POST['catName'];          
                    $update_cat = $category->update_category($idCate,$catName);
                    if($update_cat){
                        echo $update_cat;
                    }
                }
            }
            ?>
            <table class="form">					
                <tr>
                    <?php
                    $query_take = $category->getCatById($idCate);
                    if($query_take){
                        $row = $query_take->fetch_assoc();
                        ?>
                        <td>
                            <input type="text" name="catName" value="<?=$row['catName'];?>" class="medium" />
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="update" Value="Update" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>
<?php include 'inc/footer.php';?>