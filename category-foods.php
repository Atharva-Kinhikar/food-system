<?php include("partials/menu.php"); ?>
<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM category WHERE id=$category_id";
        $res = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($res);
        $c_title = $row['title'];
    }
    else
    {
        header("Location:".SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $c_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * FROM food WHERE category_id=$category_id";
                $res2 = mysqli_query($con,$sql2);
                $count = mysqli_num_rows($res2);
                if($count>0)
                {
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $f_id = $row2['id'];
                        $title = $row2["title"];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $image = $row2['image_name'];
            ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image=="")
                    {
                        echo '<div class="error"><h3>Image not available.</h3></div>';
                    }
                    else
                    {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food-image/<?php echo $image;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                    <?php
                    }
                    ?>                
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">₹ <?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?> 
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?fdid=<?php echo $f_id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
                    }
                }
                else
                {
                    echo '<div class="error"><h1>Food not available.</h1></div>';
                }
            ?>

            <div class="clearfix"></div>           

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include("partials/footer.php"); ?>
   