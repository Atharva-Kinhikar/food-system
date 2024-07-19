<?php include('partials/menu.php');?>

<div class="main-content">
     <div class="wrapper">
          <h1>Change Password</h1><br><br>
          <?php
          if(isset($_GET['id']))
          {
               $id = $_GET['id'];
          }
          ?>
          <form action="" method="POST">
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <table class="tbl-30">
                    <tr>
                         <td>Enter current password : </td>
                         <td><input type="text" name="oldPass" placeholder="Enter current password" required></td>
                    </tr>
                    <tr>
                         <td>Enter new password : </td>
                         <td><input type="text" name="newPass" placeholder="Enter new password" required></td>
                    </tr>
                    <tr>
                         <td>Confirmed password : </td>
                         <td><input type="text" name="cnfPass" placeholder="Enter confirm password" required></td>
                    </tr>
                    <tr>
                         <td colspan="2"><input name="submit" type="submit" value="Change password"
                                   class="btn-secondary">
                         </td>
                    </tr>
               </table>
          </form>
     </div>
</div>
<?php include('partials/footer.php');?>
<?php
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $oldPass = md5($_POST['oldPass']);
        $newPass = md5($_POST['newPass']);
        $cnfPass = md5($_POST['cnfPass']);


        $sql = "SELECT * FROM admin WHERE id = $id AND password = '$oldPass' ";
        $res = mysqli_query($con, $sql);       
        if($res==TRUE)
        {
             $count = mysqli_num_rows($res);      
            if($count==1)
            {
               if($newPass==$cnfPass)
               {
                    $sql2 = "UPDATE admin SET password='$newPass' WHERE id=$id";
                    $res2 = mysqli_query($con, $sql2);  
                    if($res2==true)
                    {
                         $_SESSION['cp'] = "<div class='success'><h3>Password updated successfully.</h3></div>";
                         header("location:".SITEURL."admin/manage-admin.php");            
                    }
                    else
                    {
                         $_SESSION['cp'] = "<div class='error'><h3>Failed to update password.</h3></div>";
                         header("location:".SITEURL."admin/manage-admin.php");
                    }   
               }
               else
               {
                    $_SESSION['noPwd'] = "<div class='error'><h3>New password and confirm password did not match .</h3></div>";
                    header("location:".SITEURL."admin/manage-admin.php");
               }
            }      
        }
        else
        {
            $_SESSION['noAdmin'] = "<div class='error'><h3>Admin not found !</h3></div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
    }
?>