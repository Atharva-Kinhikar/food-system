<?php include('partials/menu.php');?>
<div class="main-content">
     <div class="wrapper">
          <h1>Update Admin</h1><br><br>
          <?php
           $id = $_GET['id']; 
           $sql = "SELECT * FROM admin WHERE id=$id";
           $res = mysqli_query($con, $sql);
           if($res == TRUE)
           {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $fullname = $row['fullname'];
                    $username = $row['username'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
           }
        ?>
          <form action="" method="post">
               <input type="hidden" name="id" value="<?php echo $id?>">
               <table class="tbl-30">
                    <tr>
                         <td>Full name : </td>
                         <td><input type="text" name="full-name" value="<?php echo $fullname;?>" required></td>
                    </tr>
                    <tr>
                         <td>Username : </td>
                         <td><input type="text" name="user-name" value="<?php echo $username;?>" required></td>
                    </tr>
                    <tr>
                         <td colspan="2"><input name="submit" type="submit" value="Update Admin" class="btn-secondary">
                         </td>
                    </tr>
               </table>
          </form>
     </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $fullname = $_POST['full-name'];
        $username = $_POST['user-name'];
        $sql = "UPDATE admin SET username = '$username' , fullname = '$fullname' WHERE id = '$id' ";
        $res = mysqli_query($con, $sql);       
        if($res==TRUE)
        {
            $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
            header("location:".SITEURL."admin/manage-admin.php");            
        }
        else
        {
            $_SESSION['update'] = "<div class='success'>Failed to update admin.</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
    }
?>
<?php include('partials/footer.php');?>