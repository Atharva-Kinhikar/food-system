<?php include('partials/menu.php')?>
<div class="main-content">
     <div class="wrapper">
          <h1>Update order</h1>
          <br><br>
          <?php
          if(isset($_GET['id']))
          {
               $id = $_GET['id'];
               $sql = "SELECT * FROM orders WHERE id=$id";
               $res = mysqli_query($con,$sql);
               $row = mysqli_fetch_assoc($res);
               $food = $row['food'];
               $price = $row['price'];
               $quantity = $row['quantity'];
               $total = $row['total'];
               $status = $row['status'];
               $c_name = $row['c_name'];
               $c_contact = $row['c_contact'];
               $c_email = $row['c_email'];
               $c_address = $row['c_address'];
          }
          else
          {
               header("location:".SITEURL."admin/manage-order.php");
          }
          ?>

          <form action="" method="post">
               <table class="tbl-30">
                    <tr>
                         <td>Food Name :</td>
                         <td><input type="text" readonly value="<?php echo $food; ?>"> </td>
                    </tr>

                    <tr>
                         <td>Price :</td>
                         <td><input type="text" readonly value="₹ <?php echo $price; ?>"> </td>
                    </tr>

                    <tr>
                         <td>Quantity :</td>
                         <td><input type="text" readonly value="<?php echo $quantity; ?>"> </td>
                    </tr>
                    
                    <tr>
                         <td>Total Price :</td>
                         <td><input type="text" readonly value="₹ <?php echo $total; ?>"> </td>
                    </tr>

                    <tr>
                         <td>* Status :</td>
                         <td>
                         <select name="status"> 
                              <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                              <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                              <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                              <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                         </select> 
                         </td>
                    </tr>

                    <tr>
                         <td>Customer Name : </td>
                         <td><input type="text" readonly value="<?php echo $c_name; ?>"> </td>
                    </tr>

                    <tr>
                         <td>Customer Contact: </td>
                         <td><input type="text" readonly value="<?php echo $c_contact; ?>"> </td>
                    </tr>

                    <tr>
                         <td>Customer Email: </td>
                         <td>
                         <input type="text"readonly value="<?php echo $c_email; ?>"> 
                         </td>
                    </tr>

                    <tr>
                         <td>* Customer Address: </td>
                         <td>
                         <textarea name="c_address" cols="30" rows="5"><?php echo $c_address; ?></textarea>
                         </td>
                    </tr>

                    <tr>
                         <td colspan="2">
                         <input type="hidden" name="id" value="<?php echo $id; ?>">
                         <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                         </td>
                    </tr>
               </table>
          </form>

     <?php
     if(isset($_POST['submit']))
     {
          $id = $_POST['id'];
          $status = $_POST['status'];
          $address = $_POST['c_address'];

          $sql2 = "UPDATE orders SET status='$status', c_address='$address' WHERE id=$id";
          $res2 = mysqli_query($con,$sql2);
          if($res2)
          {
               $_SESSION['update'] = '<div class="success">Order updated.</div>';
               header("location:".SITEURL."admin/manage-order.php");
          }
          else
          {
               $_SESSION['update'] = '<div class="error">Failed to update order.</div>';
               header("location:".SITEURL."admin/manage-order.php");
          }
     }
     ?>

     </div>
</div>
<?php include('partials/footer.php')?>