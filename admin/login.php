<?php include("../config/constants.php")?>
<!DOCTYPE html>
<html lang="en">

     <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Login - Food Order System</title>
          <link rel="stylesheet" href="../css/admin.css">
          <style>
               body{
                    background: url('../images/swiggy.webp');
                    background-repeat: no-repeat;  
                    background-size: cover;
               }
          </style>
     </head>

     <body class='left'>
          <div class="login text-center">
               <h1 class="s45">Login</h1><br>
               <?php 
               if(isset($_SESSION['login']))
               {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
               }               
               
               if(isset($_SESSION['no-login-msg']))
               {
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
               }               
               ?>
               <br>
               <form action="" method="post">
                    <h3>Username :</h3> <input type="text" name="username" placeholder="Enter your username here" required><br><br>
                    <h3>Password :</h3> <input type="password" name="password" placeholder="Enter your password here" required><br><br>
                    <input type="submit" value="Login" name="submit" class="btn-primary">
               </form>
               <br>
               <p>Created by Shailesh M Mestry</p>
          </div>
     </body>

</html>
<?php
if(isset($_POST['submit']))
{
     $username = $_POST['username'];
     $password = md5($_POST['password']);

     $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

     $res = mysqli_query($con,$sql);
     $count = mysqli_num_rows($res);
     $row = mysqli_fetch_assoc($res);
     $a_name=$row['fullname']; 

     if($count==1)
     {
          $_SESSION['user'] = $username;
          $_SESSION['login'] = "<div class='success'><h3>Hello, ".$a_name." !</h3></div>";
          header("location:".SITEURL."admin");
     }
     else
     {
          $_SESSION['login'] = "<div class='error'><h3>Failed to login</h3></div>";
          header("location:".SITEURL."admin/login.php");
     }
}
?>