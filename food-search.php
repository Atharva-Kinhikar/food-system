<?php include("partials/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php $search = $_POST['search']; ?>            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
    
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
    
            <?php
                
                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'" ;
                $res = mysqli_query($con,$sql);
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $price = $row['price'];
                        $title = $row['title'];
                        $image = $row['image_name'];
                        $description = $row['description'];
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

                    <a href="<?php echo SITEURL; ?>order.php?fdid=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <?php
                    }
                }
                else
                {
                    echo '<div class="error"><h1>Food Not Available.</h1></div>';
                }
            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials/footer.php"); ?>