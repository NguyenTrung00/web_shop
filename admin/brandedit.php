<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/brand.php"?>

<?php
$brand = new Brand();
if(!isset($_GET['idbrand']) || $_GET['idbrand'] == NULL){
    echo "<script>window.location='brandlist.php'</script>";
}else{
    $id = $_GET['idbrand'];
} 

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
         <form action="" method="post"> 
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['update'])){
                    $name = $_POST['brandName'];
                    $update_brand = $brand->update_brand($id, $name);
                    if($update_brand){
                        echo $update_brand;
                    }
                }
            }
            ?>
            <table class="form">					
                <tr>
                    <?php
                    $brand_list = $brand->getBrandById($id);
                    if($brand_list){
                        while($row = $brand_list->fetch_assoc()){
                            ?>
                            <td>
                                <input type="text" name="brandName" value="<?= $row['brandName'];?>" class="medium" />
                            </td>
                            <?php
                        }
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