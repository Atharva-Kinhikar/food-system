<?php 
include('partials/menu.php')
?>
<!-- Main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order </h1>
        <br>
        <?php
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
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Customer</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Status of Delivery</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM orders ORDER BY order_date DESC";
                $res = mysqli_query($con,$sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $quantity = $row['quantity'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $c_name = $row['c_name'];
                        $c_contact = $row['c_contact'];
                        $c_address = $row['c_address'];
            ?>
            <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $food;?></td>
                <td><?php echo $price;?></td>
                <td><?php echo $quantity ;?></td>
                <td><?php echo $total ;?></td>
                <td><?php echo $order_date ;?></td>
                <td><?php echo $c_name ;?></td>
                <td><?php echo $c_contact ;?></td>
                <td><?php echo $c_address ;?></td>
                <td>
                    <?php
                        if($status=="Ordered")
                        {
                            echo "<b>$status</b>";
                        }
                        elseif($status=="On Delivery")
                        {
                            echo "<b style='color:blue;'>$status</b>";
                        }   
                        elseif($status=="Delivered")
                        {
                            echo "<b style='color:green;'>$status</b>";
                        }
                        else
                        {
                            echo "<b style='color:red;'>$status</b>";
                        }
                    ?>
                </td>
                <td>
                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update</a>
                </td>
            </tr>
            <?php
                    }
                }
                else
                {
                    echo '<tr><td colspan="11"><div class="error">Orders not availabale</div></td></tr>';
                }
            ?>
            

        </table>
    </div>
</div>
<!-- Main content section ends -->

<?php 
include('partials/footer.php')
?>