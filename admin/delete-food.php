<?php
include("../config/constants.php");

if(isset($_GET['id']) AND isset($_GET['image']))
{
     $id = $_GET['id'];
     $image_name = $_GET['image'];

     
          
     $sql = "DELETE FROM food WHERE id=$id";
     $res = mysqli_query($con, $sql);
     if($res)
     {
          if($image_name!="")
          {
               $path = "../images/food-image/".$image_name;
               $remove = unlink($path);
               if($remove==false)
               {
                    $_SESSION['remove'] = '<div class="error">Failed to remove food-image.</div>';
                    die();
                    header("location:".SITEURL."admin/manage-food.php");
               }
          }
          $_SESSION['remove'] = '<div class="success">Food deleted.</div>';
          header("location:".SITEURL."admin/manage-food.php");
     }
     else
     {
          $_SESSION['remove'] = '<div class="error">Failed to delete food.</div>';
          header("location:".SITEURL."admin/manage-food.php");
     }
     
}
else
{
     header("location:".SITEURL."admin/manage-food.php");
}

?>