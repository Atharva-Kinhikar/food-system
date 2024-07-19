<?php include("partials/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php
if(isset($_SESSION['placement']))
{
    echo $_SESSION['placement'];
    unset($_SESSION['placement']);
}
?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql = "SELECT * FROM category WHERE active='YES' AND featured='Yes' LIMIT 3";
                $res = mysqli_query($con,$sql);
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $title = $row['title'];
                        $id = $row['id'];
                        $image = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                if($image=="")
                                {
                                    echo '<div class="error"><h3>Image not available.</h3></div>';
                                }
                                else
                                {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category-image/<?php echo $image;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                <?php
                                }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    echo '<div class="error"><h2>Category not added.</h2></div>';
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($con,$sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                while($row2=mysqli_fetch_assoc($res2))
                    {
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $id = $row2['id'];
                        $image_name = $row2['image_name'];
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        echo '<div class="error"><h3>Image not available</h3></div>';
                                    }
                                    else
                                    {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food-image/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
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

                                <a href="<?php echo SITEURL; ?>order.php?fdid=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php
                    }
            }
            else
            {
                echo '<div class="error"><h2>Food not available.</h2></div>';
            }
            ?>
            
            <div class="clearfix"></div>   
        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials/footer.php"); ?>