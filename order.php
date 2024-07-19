<?php include("partials/menu.php"); ?>
<?php
if(isset($_GET['fdid']))
{
    $foodid = $_GET['fdid'];
    $sql = "SELECT * FROM food WHERE id = $foodid";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    $title = $row['title'];
    $price = $row['price'];
    $image_name = $row['image_name'];
}
else
{
    header('location:'.SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name=="")
                            {
                                echo '<div class="error"><h3>Image not available.</h3></div>';
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/food-image/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">₹ <?php echo $price; ?></p>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name"  class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="text" pattern="[789][0-9]{9}" name="contact"  class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email"  class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10"  class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
<?php
if(isset($_POST['submit']))
{
    $food = $_POST['food'];
    $c_name = $_POST['full-name'];
    $c_email = $_POST['email'];
    $c_contact = $_POST['contact'];
    $c_address = $_POST['address'];
    $pricee = $_POST['price'];
    $quantity = $_POST['qty'];
    $total = ($price * $quantity);
    $status = "Ordered";
    date_default_timezone_set('Asia/Kolkata');
    $orderdate = date("d-m-Y H:i:s");

    echo $sql2 = "INSERT INTO orders SET food='$food', c_name='$c_name', c_email='$c_email', c_contact='$c_contact', c_address='$c_address', price=$pricee, quantity=$quantity, total=$total, status='$status', order_date='$orderdate'";

    $res2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
    if($res2)
    {
        $_SESSION['placement'] = '<div class="success text-center">Order placed successfully.</div>';
        header("location:".SITEURL);
    }
    else
    {
        $_SESSION['placement'] = '<div class="error text-center">Failed to place order.</div>';
        header("location:".SITEURL);
    }
}
?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include("partials/footer.php"); ?>