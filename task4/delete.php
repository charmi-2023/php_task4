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