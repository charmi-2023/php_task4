<?php
$conn = mysqli_connect("localhost", "root", "root", "user_db");

if (!$conn) {
   die("Database connection failed");
}

$id = $_GET['id'];

$query1 = "SELECT * FROM user_form WHERE id = '$id'";
$result = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit</title>
   <style>
   body {
       background-color: lightpink;
       font-family: Arial, sans-serif;
       margin: 0;
       padding: 20px;
   }

   h1 {
       color: black;
       margin-bottom: 20px;
   }

   label {
       font-weight: bold;
   }

   input[type="text"],
   input[type="email"],
   input[type="password"] {
       width: 300px;
       padding: 10px;
       margin-bottom: 10px;
   }

   input[type="file"] {
       margin-bottom: 10px;
   }

   button {
       background-color: lightcoral;
       color: white;
       border: none;
       padding: 10px 20px;
       cursor: pointer;
       font-size: 16px;
   }

   a {
       color: black;
       text-decoration: none;
       margin-top: 20px;
       display: inline-block;
   }
   </style>
</head>
<body>
   <form action="" method="post" enctype="multipart/form-data">
       <h1>Edit Record</h1>
       <label>Name:</label>
       <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']) ?>"><br>
       <label>Email:</label>
       <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']) ?>"><br>
       <label>Password:</label>
       <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']) ?>"><br>
       <input type="file" name="image">
       <input type="hidden" name="id" value="<?php echo $id; ?>">

       <button type="submit" name="edit">Update Record</button><br><br>
   </form>
   <a href="admin_page.php">Go Back</a><br><br>
</body>
</html>

<?php
if (isset($_POST['edit'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $id = $_POST['id'];

   $md5_password = md5($password);
   $imagefile = $_FILES['image']['name'];
   $temp_name = $_FILES['image']['tmp_name'];
   $folder = "../task1registration/uploaded_image/".$imagefile;

   $sql = "UPDATE user_form SET name = '$name', email = '$email', password = '$md5_password', image = '$imagefile' WHERE id = '$id'";
   $result = mysqli_query($conn, $sql);

   if ($result) {
       move_uploaded_file($temp_name, $folder);
       echo "Record edited successfully";
   } else {
       echo "Error: " . mysqli_error($conn);
   }
}
?>

