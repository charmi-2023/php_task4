<?php
$conn = mysqli_connect("localhost", "root", "root", "user_db");

if (!$conn) {
    die("Database connection failed");
}

$id = $_GET['id'];

$query1 = "SELECT * FROM user_form WHERE id = ?";
$stmt = mysqli_prepare($conn, $query1);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
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
        <input type="text" name="name" value="<?php echo $row['name'] ?>"><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $row['email'] ?>"><br>
        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $row['password'] ?>"><br>
        <input type="file" name="image">

        <button type="submit" name="Edit">Update Record</button><br><br>
    </form>
    <button><a href="view_details1.php">Back</a></button><br><br>
</body>
</html>

<?php
if (isset($_POST['Edit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $imagefile = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $folder = "../task1registration/uploaded_image/".$imagefile;

    $sql = "UPDATE user_form SET name = ?, email = ?, user_type = ?, password = ?, image = '$imagefile' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $user_type, $hashed_password, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Record edited successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
