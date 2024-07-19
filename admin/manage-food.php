<?php 
include('partials/menu.php')
?>
<!-- Main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food </h1>
        <br><br>
        <!--Button for adding food-->
        <a href="add-food.php" class="btn-primary">Add food</a><br><br>
        <?php
            if(isset($_SESSION['food']))
            {
                echo $_SESSION['food'];
                unset($_SESSION['food']);
            }
            
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['removel']))
            {
                echo $_SESSION['removel'];
                unset($_SESSION['removel']);
            }
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
               
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

          ?>
        <br>

        <table class="tbl-full">
            <tr>
                <th>Sr.no</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM food ORDER BY id DESC";
                $res = mysqli_query($con, $sql);
                $count = mysqli_num_rows($res);
                $sn = 0;
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        $title = $row['title'];
                        $sn++;
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $price; ?></td>
                <td>
            <?php
                if($image_name !="")
                {
                    ?>  
                        <img width="150px" src="<?php echo SITEURL; ?>images/food-image/<?php echo $image_name;?>" alt="category image">
                    <?php

                }
                else
                {
                    echo "<h3 class='error'>Image not available.</h3>";
                }
            ?>
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                </td>
            </tr>
            <?php
                    }
                }
                else
                {
                    ?>
                        <tr>
                            <td colspan = "7"><div class="error"><h3>No food added.</h3></div></td>
                        </tr>
                    <?php
                }
            ?>

        </table>
    </div>
</div>
<!-- Main content section ends -->

<?php 
include('partials/footer.php')
?>