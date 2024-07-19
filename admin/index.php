<?php 
include('partials/menu.php')
?>

<!-- Main content section starts -->
<div class="main-content">
     <div class="wrapper">
          <h1>DASHBOARD </h1><br>
          <?php 
               if(isset($_SESSION['login']))
               {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
               }               
          ?>
          <br>
          <div class="col-4 text-center">
          <img src="<?php echo SITEURL?>images/category.jpg" width="200px" alt=""><br> <br>
                    <?php
                         $sql = "SELECT * FROM category";
                         $res = mysqli_query($con, $sql);
                         $count = mysqli_num_rows($res);
                    ?>
               <h1><?php echo $count;?></h1><br><h3>Category</h3>
               <br><br>              
          </div>

          <div class="col-4 text-center">
          <img src="<?php echo SITEURL?>images/food.jpg" width="200px" alt=""><br> <br>
               <?php
                    $sql = "SELECT * FROM food";
                    $res = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($res);
               ?>
               <h1><?php echo $count;?></h1><br><h3>Foods</h3>
          </div>

          <div class="col-4 text-center">
          <img src="<?php echo SITEURL?>images/order.png" width="200px" alt=""><br> <br>
               <?php
                    $sql = "SELECT * FROM orders WHERE status != 'Cancelled'";
                    $res = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($res);
               ?>
               <h1><?php echo $count;?></h1><br><h3>Orders</h3>
          </div>
          <div class="col-4 text-center">
          <img src="<?php echo SITEURL?>images/revenue.png" width="200px" alt=""><br> <br>
               <?php
                    $sql = "SELECT SUM(total) AS total FROM orders WHERE status='Delivered'";
                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($res);
               ?>
               <h1><?php echo $row['total'];?></h1><br><h3>Revenue</h3>
          </div>
          <div class="clear-fix"></div>
     </div>
</div>
<!-- Main content section ends -->

<?php
include('partials/footer.php')
?>