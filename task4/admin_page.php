<?php

include 'config.php';
include "view_details1.php";

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Hello, </h3>
      <h1>welcome <span><?php echo $_SESSION['user_type'] ." ". $_SESSION['name'];?></span></h1>
    
    
      <form method="post">
      <input type="submit" class="btn" name="view" value="View">
</form>
      <a href="logout.php" class="btn" value ="logout">logout</a>
      <a href="add_user.php" class="btn">Add User</a>
      <?php if($_SESSION['user_type'] == "admin" || $_SESSION['user_type'] == "teacher"){
         ?>
      <a href="subject_section.php" class ="btn">Manage Subjects</a>
      <a href="chapter_section.php" class ="btn">Manage Chapters</a>
      <a href="standard_section.php" class ="btn">Manage Standards</a>
      <a href="assign_chapter.php" class="btn">Assign Chapters</a>
      <a href="assign_subject_to_standard.php" class ="btn"> Assign subject</a>
      <a href="assign_student_to_standard.php" class ="btn"> Assign student</a>

         <?php }?>

   </div>

</div>

</body>
</html>
