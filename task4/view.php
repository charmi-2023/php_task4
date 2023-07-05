<?php
session_start();
if(!(isset($_SESSION['log_in'])) || $_SESSION['log_in']!==true){
   header("location:login_form.php");
}
else{

?>


<?php


$conn = mysqli_connect('localhost', 'root', 'root', 'user_db');

if(isset($_GET['id']));{
$id = $_GET['id'];

// Retrieve the data for the specific row from the database
$sql = "SELECT * FROM `user_form` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$image = $row['image'];
$imagefile = $_FILES['image']['name'];

}

?>


<!DOCTYPE html>
<html>

<head>
    <title>View Row Data</title>
    <style>

        body{
            background-color: #ddd;
        }
        .image{
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <h2>Row Data</h2>
    <p><img class="image" src="../task1/uploaded_image/<?php echo $image;?>"></p>
    <p>Id: <?php echo $row['id'] ?></p>
    <p>Name: <?php echo $row['name'] ?></p>
    <p>Email: <?php echo $row['email'] ?></p>
    <p>Password: <?php echo $row['password'] ?></p>
    <a href="admin_page.php">Back</a>
    
</body>

</html>

<?php
}
?>