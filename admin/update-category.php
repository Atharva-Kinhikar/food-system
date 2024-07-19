<?php include('partials/menu.php')?>
<div class="main-content">
     <div class="wrapper">
          <h1>Update Category</h1>
          <br><br>  

          <?php
               if(isset($_GET['id']))
               {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM category WHERE id = $id";
                    $res = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                         $row = mysqli_fetch_assoc($res);
                         $title = $row['title'];
                         $image = $row['image_name'];
                         $active = $row['active'];
                         $featured = $row['featured'];
                    }
                    else
                    {
                         $_SESSION['no-cat'] = '<div class="error"><h3>No Category found.</h3></div>';
                         header("location:".SITEURL."/admin/manage-category.php");
                    }
               }
               else
               {
                    header("location:".SITEURL."/admin/manage-category.php");
               }
          ?>
          <form action="" method="post" enctype="multipart/form-data">
               <table class="tbl-30">
                    <tr>
                         <td>Title :</td>
                         <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                         <td>Current Image :</td>
                         <td>
                              <?php
                              if($image != "")
                              {
                              ?>
                                   <img src="<?php echo "../images/category-image/".$image ;?>" alt="image" width="150px">
                              <?php
                              }
                              else
                              {
                                   echo '<div class="error">Image not added.</div>';
                              }
                              ?>
                         </td>
                    </tr>
                    <tr>
                         <td>New Image :</td>
                         <td><input type="file" title="Image size must be less than 2 mb" name="nimage"></td>
                    </tr>
                    <tr>
                         <td>Featured :</td>
                         <td>
                              <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                              <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                         </td>
                    </tr>
                    <tr>
                         <td>Active :</td>
                         <td>
                              <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                              <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <input type="hidden" name="image" value="<?php echo $image; ?>">
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                              <input class="btn-secondary" type="submit" name="submit" value="Update Category">
                         </td>
                    </tr>
               </table>
          </form>
          <?php
          if(isset($_POST['submit']))
          {
               $id = $_POST['id'];
               $cimage = $_POST['image'];
               $title = $_POST['title'];
               $active = $_POST['active'];
               $featured = $_POST['featured'];

               if(isset($_FILES['nimage']['name']))
               {
                    //$f = $_FILES['nimage'];
                    //print_r($f);
                    $image_name = $_FILES['nimage']['name'];
                    if($image_name!="")
                    {
                         $extension = explode(".", $image_name);
                         $image_name = "Food_Category_".rand(000,999).".".$extension[count($extension)-1];
                         $source_path = $_FILES['nimage']['tmp_name'];
                         $destination_path = "../images/category-image/".$image_name;
                         $upload = move_uploaded_file($source_path,$destination_path);
                         if($upload==false)
                         {
                              $_SESSION['upload'] = "<div class=\"error\"><h3>Failed to upload image.</h3></div>";
                              header("location:".SITEURL."admin/manage-category.php");
                              die();
                         }
                         if($cimage != "")
                         {
                              $remove = unlink("../images/category-image/".$cimage);
                              if(!$remove)
                              {
                                   $_SESSION['removel'] = "<div class=\"error\"><h3>Failed to remove image.</h3></div>";
                                   header("location:".SITEURL."admin/manage-category.php");
                                   die();
                              }
                         }
                    }
                    else
                    {
                         $image_name = $cimage;
                    }
               }
               else
               {
                    $image_name = $cimage;
               }


               $sql2 = "UPDATE category SET title = '$title', active='$active', featured='$featured', image_name='$image_name' WHERE id=$id";

               $res2 = mysqli_query($con, $sql2) ;//or die(mysqli_error($con));
               if($res2)
               {
                    $_SESSION['update'] = '<div class="success">Category updated.</div>';
                    header("location:".SITEURL."admin/manage-category.php");
               }
               else
               {
                    $_SESSION['update'] = '<div class="error">Failed to update category.</div>';
                    header("location:".SITEURL."admin/manage-category.php");
               }
          }
          ?>
     </div>
</div>
<?php include('partials/footer.php')?>
