<?php include("partials/menu.php")?>
<div class="main-content">
     <div class="wrapper">
          <h1>Add Category</h1><br><br>
          <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
          <!--Form starts-->
          <form action="" method="POST" enctype="multipart/form-data">
               <table class="tbl-30">
                    <tr>
                         <td>Title : </td>
                         <td>
                              <input type="text" name="title" placeholder="Enter name of category" required>
                         </td>
                    </tr>
                    <tr>
                         <td>Select Image :</td>
                         <td><input type="file" name="image" title="Image size must be less than 2 mb"></td>
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
                              <input type="submit" name="submit" value="Add category" class="btn-secondary">
                         </td>
                    </tr>
               </table>
          </form>
          <?php
               if(isset($_POST['submit']))
               {
                    $title = $_POST['title'];

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
                    
                    if(isset($_FILES['image']['name']))
                    {
                         $image_name = $_FILES['image']['name'];
                         if($image_name != "")
                         {                              
                              $extension = explode('.', $image_name);
                              $image_name = "Food_Category_".rand(000,999).".".$extension[count($extension)-1];
                              $source_path = $_FILES['image']['tmp_name'];
                              $destination_path = "../images/category-image/".$image_name;
                              $upload = move_uploaded_file($source_path,$destination_path);
                              if($upload==false)
                              {
                                   $_SESSION['upload'] = "<div class=\"error\"><h3>Failed to upload image.</h3></div>";
                                   header("location:".SITEURL."admin/add-category.php");
                                   die();
                              }
                         }
                    }
                    else
                    {
                         $image_name = "";
                    }

                    $sql = "INSERT INTO category SET title='$title', image_name='$image_name',featured='$featured', active='$active'";
                    $res = mysqli_query($con, $sql); 
                    if($res)
                    {
                         $_SESSION['add'] = "<div class='success'><h3>Category added succesfully.</h3></div>";
                         header("location:".SITEURL."admin/manage-category.php");
                    }
                    else
                    {
                         $_SESSION['add'] = "<div class='error'><h3>Failed to add category.</h3></div>";
                         header("location:".SITEURL."admin/manage-category.php");
                    }
               }
          ?>
     </div>
</div>
<?php include("partials/footer.php")?>