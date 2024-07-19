<?php
if(!isset($_SESSION['user']))
{
     $_SESSION['no-login-msg'] = "<div class='error'><h3>Something went wrong try again !</h3></div>";
     header("location:".SITEURL."admin/login.php");
}
?>