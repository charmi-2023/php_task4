<?php
session_start();
if(!(isset($_SESSION['log_in'])) || $_SESSION['log_in']!==true){
   header("location:login_form.php");
}
else{

?>

<?php
include "config.php";


if(isset($_GET['delete'])){

    $id = $_GET['delete'];
  
    $sql_delete = "DELETE FROM `user_form` WHERE `id`='$id'";
    print_r($result);
    $result= mysqli_query($conn, $sql_delete);
    $_POST['view']=true;
    
}
?>

<?php
}
?>