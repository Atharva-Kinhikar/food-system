<?php
include("../config/constants.php");

if(isset($_GET['id']) AND isset($_GET['image']))
{
     $id = $_GET['id'];
     $image_name = $_GET['image'];

     if($image_name != "")
     {
          
          $sql = "DELETE FROM category WHERE id=$id";
          $res = mysqli_query($con, $sql);
          if($res)
          {
               $path = "../images/category-image/".$image_name;
               $remove = unlink($path);
               if($remove==false)
               {
                    $_SESSION['remove'] = '<div class="error">Failed to remove image.</div>';
                    die();
                    header("location:".SITEURL."admin/manage-category.php");
               }
               $_SESSION['remove'] = '<div class="success">Category deleted.</div>';
               header("location:".SITEURL."admin/manage-category.php");
          }
          else
          {
               $_SESSION['remove'] = '<div class="error">Failed to delete category.</div>';
               header("location:".SITEURL."admin/manage-category.php");
          }
     }
}
else
{
     header("location:".SITEURL."admin/manage-category.php");
}

?>