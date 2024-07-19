<?php include('partials/menu.php'); ?>
<div class="main-content">
     <div class="wrapper">
          <h1>Add admin</h1>
          <br><br>
          <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?><br><br>

          <form action="" method="post">
               <table class="tbl-30">
                    <tr>
                         <td>Full name:</td>
                         <td><input type="text" placeholder="Enter your full name" name="fullname" required></td>
                    </tr>
                    <tr>
                         <td>Username:</td>
                         <td><input type="text" placeholder="Enter your username" name="username" required></td>
                    </tr>
                    <tr>
                         <td>Password:</td>
                         <td><input type="password" placeholder="Enter your password" name="password" required></td>
                    </tr>
                    <tr>
                         <td colspan="2"><input class="btn-secondary" name="submit" type="submit" value="Add Admin">
                         </td>
                    </tr>
               </table>
          </form>
     </div>
</div>
<?php include('partials/footer.php'); ?>

<?php
// Processing on value of the form.
if(isset($_POST["submit"]))
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);//password encryption function md5()

    $sql = "INSERT INTO admin SET fullname='$fullname', username='$username', password='$password'";
    $result = mysqli_query($con, $sql) or die(mysqli_error());
    if($result == TRUE)
    {
        $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
        header("location:".SITEURL."/admin/manage-admin.php");
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
        header("location:".SITEURL."/admin/add-admin.php");
    }
}
?>