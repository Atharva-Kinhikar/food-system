<?php 
include('partials/menu.php')
?>

<!-- Main content section starts -->
<div class="main-content">
     <div class="wrapper">
          <h1>Manage Admin </h1><br><br>

          <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        if(isset($_SESSION['noAdmin']))
        {
            echo $_SESSION['noAdmin'];
            unset($_SESSION['noAdmin']);
        }
        
        if(isset($_SESSION['noPwd']))
        {
            echo $_SESSION['noPwd'];
            unset($_SESSION['noPwd']);
        }
        
        if(isset($_SESSION['cp']))
        {
            echo $_SESSION['cp'];
            unset($_SESSION['cp']);
        }

        ?><br><br>

          <!--Button for adding admin-->
          <br><a href="add-admin.php" class="btn-primary">Add admin</a><br><br><br>
          <table class="tbl-full">
               <tr>
                    <th>Sr.no</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
               </tr>

               <?php
                $sn =1;
                $sql = "SELECT * FROM admin" ;
                $res = mysqli_query($con, $sql);
                if($res == TRUE)
                {
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $fullname = $rows['fullname'];
                            $username = $rows['username'];

                            ?>

               <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $fullname; ?></td>
                    <td><?php echo $username; ?></td>
                    <td>
                         <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"
                              class="btn-primary">Change password</a>
                         <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                              class="btn-secondary">Update Admin</a>
                         <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                              class="btn-danger">Delete Admin</a>
                    </td>
               </tr>
               <?php
                        }
                    }
                }
            
            ?>



          </table>
     </div>
</div>
<!-- Main content section ends -->

<?php
include('partials/footer.php')
?>