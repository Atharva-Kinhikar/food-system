<?php include("partials/menu.php");?>

<?php

     if(isset($_GET['id']))
     {
          $fid = $_GET['id'];
          $sql2 = "SELECT * FROM food WHERE id=$fid";
          $res2=mysqli_query($con,$sql2);               
          $row2 = mysqli_fetch_assoc($res2);
          $title = $row2['title'];
          $description = $row2['description'];
          $price = $row2['price'];
          $current_image = $row2['image_name'];
          $current_category = $row2['category_id'];
          $featured = $row2['featured'];
          $active = $row2['active'];            
          
     }
     else
     {
          header("location:".SITEURL."admin/manage-food.php");
     }
?>

<div class="main-content">
     <div class="wrapper">
          <h1>Update food</h1>
     </div>
     <br><br>   
     
     <form action="" enctype="multipart/form-data" method="post">
     <table class="tbl-30">
                    <tr>
                         <td>Title : </td>
                         <td><input value="<?php echo $title; ?>" type="text" name="title" placeholder="Title of the food"></td>
                    </tr>
                    <tr>
                         <td>Description : </td>
                         <td><textarea name="description" cols="40" rows="5" placeholder="Description of the food"><?php echo $description; ?></textarea></td>
                    </tr>
                    <tr>
                         <td>Price : </td>
                         <td><input value="<?php echo $price; ?>"  type="text" name="price" placeholder="Price of the food"></td>
                    </tr>
                    <tr>
                         <td>Current Image:</td>
                         <td>
                              <?php
                                   if($current_image == "")
                                   {
                                        echo '<div class="error"><h4>Image not added.</h4></div>';
                                   }
                                   else
                                   {
                                        ?>
                                        <img src="../images/food-image/<?php echo $current_image; ?>" width="180px" alt=""> 
                                        <?php
                                   }
                              ?>
                         </td>
                    </tr>
                    <tr>
                         <td>New image : </td>
                         <td><input type="file" name="fimage"></td>
                    </tr>
                    <tr>
                         <td>Category :</td>
                         <td>
                              <select name="category">
                                   <?php
                                        $sql = "SELECT * FROM category WHERE active='Yes'";
                                        $res = mysqli_query($con, $sql);
                                        $count = mysqli_num_rows($res);
                                        if($count>0)
                                        {
                                             while($row = mysqli_fetch_assoc($res))
                                             {
                                                  $category_id = $row['id'];
                                                  $title = $row['title'];
                                   ?>
                                   <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $title;?></option>
                                   <?php
                                             }
                                        }
                                        else
                                        {
                                   ?>
                                   <option value="0">No categories found</option>
                                   <?php
                                        }
                                   ?>
                                   
                              </select>
                         </td>
                    </tr>
                    <tr>
                         <td>Featured : </td>
                         <td>
                              <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                              <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                         </td>
                    </tr>
                    <tr>
                         <td>Active : </td>
                         <td>
                              <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                              <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <input type="hidden" name="id" value="<?php echo $fid; ?>">
                              <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                              <input type="submit" name="submit" value="Update food" class="btn-secondary">
                         </td>
                    </tr>
               </table>
     </form>
     <?php
          if(isset($_POST['submit']))
          {
          
               $id = $_POST['id'];
               $current_image = $_POST['current_image'];
               $title = $_POST['title'];
               $price = $_POST['price'];
               $category = $_POST['category'];
               $description = $_POST['description'];
               $active = $_POST['active'];
               $featured = $_POST['featured'];

               if(isset($_FILES['fimage']['name']))
               {
                    $image_name = $_FILES['fimage']['name'];
                    if($image_name!="")
                    {
                         $extension = explode(".", $image_name);
                         $image_name = "Food_food_".rand(000,999).".".$extension[count($extension)-1];
                         $source_path = $_FILES['fimage']['tmp_name'];
                         $destination_path = "../images/food-image/".$image_name;
                         $upload = move_uploaded_file($source_path,$destination_path);
                         if($upload==false)
                         {
                              $_SESSION['upload'] = "<div class=\"error\"><h3>Failed to upload image.</h3></div>";
                              header("location:".SITEURL."admin/manage-food.php");
                              die();
                         }
                         if($current_image != "")
                         {
                              $removepath = "../images/food-image/".$current_image;
                              $remove = unlink($removepath);
                              if(!$remove)
                              {
                                   $_SESSION['removel'] = "<div class=\"error\"><h3>Failed to remove image.</h3></div>";
                                   header("location:".SITEURL."admin/manage-food.php");
                                   die();
                              }
                         }
                    }
                    else
                    {
                         $image_name = $current_image;
                    }
               }
               else
               {
                    $image_name = $current_image;
               }

               $sql3 = "UPDATE food SET title='$title', description='$description', price='$price', image_name='$image_name', category_id='$category', featured='$featured', active='$active' WHERE id=$fid";
               
               $res3 = mysqli_query($con, $sql3) ;//or die(mysqli_error($con));
               if($res3==true)
                {
                    
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    ob_end_flush();
                }
                else
                {
                    
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

          }

     ?>
</div>
<?php include("partials/footer.php")?>