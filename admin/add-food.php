<?php include("partials/menu.php"); ?>

<div class="main-content">
     <div class="wrapper">
          <h1>
               Add Food
          </h1>

          <br>
          <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

          ?><br>

          <form action="" enctype="multipart/form-data" method="post">
               <table class="tbl-30">
                    <tr>
                         <td>Title : </td>
                         <td><input type="text" name="title" placeholder="Title of the food"></td>
                    </tr>
                    <tr>
                         <td>Description : </td>
                         <td><textarea name="description" cols="40" rows="5" placeholder="Description of the food"></textarea></td>
                    </tr>
                    <tr>
                         <td>Price : </td>
                         <td><input type="text" name="price" placeholder="Price of the food"></td>
                    </tr>
                    <tr>
                         <td>Select image : </td>
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
                                                  $ctid = $row['id'];
                                                  $title = $row['title'];
                                   ?>
                                   <option value="<?php echo $ctid;?>"><?php echo $title;?></option>
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
                              <input type="radio" name="featured" value="Yes"> Yes
                              <input type="radio" name="featured" value="No"> No
                         </td>
                    </tr>
                    <tr>
                         <td>Active : </td>
                         <td>
                              <input type="radio" name="active" value="Yes"> Yes
                              <input type="radio" name="active" value="No"> No
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <input type="submit" name="submit" value="Add food" class="btn-secondary">
                         </td>
                    </tr>
               </table>
          </form>
     </div>
</div>

<?php include("partials/footer.php"); ?>

<?php
     if(isset($_POST['submit']))
     {
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];
          if(isset($_POST['featured']))
          {
               $featured = $_POST['featured'];
          }
          else
          {
               $featured = "No";
          }
          if(isset($_POST['active']))
          {
               $active = $_POST['active'];
          }
          else
          {
               $active = "No";
          }
          if(isset($_FILES['fimage']['name']))
          {
               $image_name = $_FILES['fimage']['name'];
               if($image_name != "")
               {
                    $extention = explode('.', $image_name);
                    $image_name = "Food_food_".rand(000,999).".".end($extention);
                    $sourcepath = $_FILES['fimage']['tmp_name'];
                    $destination = "../images/food-image/".$image_name;
                    $upload = move_uploaded_file($sourcepath,$destination);
                    if($upload==false)
                    {
                         $_SESSION['upload'] = '<div class="error">Failed to upload image</div>';
                         header("location:".SITEURL."admin/add-food.php");
                         die();
                    }
                    
               }
          }
          else
          {
               $image_name = "";
          }

          $sql2 = "INSERT INTO food SET title='$title', description='$description', price=$price, image_name='$image_name', category_id=$category, featured='$featured', active='$active'";
          $res2 = mysqli_query($con,$sql2);
          if($res2)
          {
               $_SESSION['food'] = '<div class="success">Food added successfully</div>';
               header("location:".SITEURL."admin/manage-food.php");
          } 
          else
          {
               $_SESSION['food'] = '<div class="error">Failed to add food</div>';
               header("location:".SITEURL."admin/manage-food.php");
          }
     }
?>