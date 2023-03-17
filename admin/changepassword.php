<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php

?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])){
        // $get_pass = 
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">               
           <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldPass" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newPass" class="medium" />
                    </td>
                </tr>


                <tr>
                    <td>
                    </td>
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