<?php include("partials/menu.php"); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories gray">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php
            $sql = "SELECT * FROM category WHERE active='Yes'";
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
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
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


    <?php include("partials/footer.php"); ?>