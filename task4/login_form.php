<?php

include 'config.php';



if(isset($_POST['submit'])){
   session_start();
   
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   
   

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   $row = mysqli_fetch_array($result);

   $new_email = $row['email'];
   $new_pass = $row['password'];
   
   $select1 = "SELECT `id`, `name` FROM `user_form` WHERE `email`='$email' AND `password`='$pass'";
    $result1 = mysqli_query($conn, $select1);
    $row1 = mysqli_fetch_array($result1);

    $id = $row1['id'];
    $name = $row1['name'];

    $select2 = "SELECT `access_type` FROM `userType` WHERE `user_id` =$id";

    $result2 = mysqli_query($conn, $select2);
    $row2 = mysqli_fetch_array($result2);

    $user_type = $row2['access_type'];

    
    $_SESSION['log_in'] = true;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['name'] = $name;
  
   if(empty($email)|| empty($pass)){
      $error = 'please fill all the info';
   
   }
   else{
      if($email == $new_email && $pass == $new_pass){
         header('location: admin_page.php');
      }
      else{
         $error2 = 'info is not matched';      
      }
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now"  class="form-btn">
      

      <?php
      echo $error,$error2;


      ?>
      <p>Don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>