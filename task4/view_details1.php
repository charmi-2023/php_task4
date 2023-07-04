<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view_details</title>
    <style>
   body {
       background-color: #FFF6F6;
       color: #FF4081;
       font-family: Arial, sans-serif;
   }

   table {
       margin-top: 20px;
       border-collapse: collapse;
       width: 70%;
       background-color: #FFF0F5;
   }

   table th,
   table td {
       padding: 10px;
       border: 1px solid #FF4081;
       text-align: center;
   }

   table th {
       background-color: #FF80AB;
       color: #FFFFFF;
   }

   table td a {
       text-decoration: none;
       color: #FF4081;
       padding: 5px 10px;
       border: 1px solid #FF4081;
       border-radius: 3px;
   }

   table td a:hover {
       background-color: #FF4081;
       color: #FFFFFF;
   }

   div a {
       color: #FF4081;
       text-decoration: none;
   }

   div a:hover {
       text-decoration: underline;
   }

   </style>
</head>
<body>
    
<?php
include "config.php";


if(isset($_GET['delete'])){

    $id = $_GET['delete'];


    $sql_delete = "DELETE FROM `user_form` WHERE `id`='$id'";
 
    $result= mysqli_query($conn, $sql_delete);
    $_POST['view']=true;
    
}

if (isset($_POST['view'])) {
    $query = "SELECT * FROM user_form";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<table align='center' border='2px'>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>password</th>
                    <th>action</th>
                    
  
                </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . "<a class='btn' href='edit.php?id=".$row['id']."'> Edit </a>". "<a class='btn' href='view_details1.php?delete=".$row['id']."'>Delete</a>" . "<a class='btn' href='view.php?id=".$row['id']."'> View </a>" ."</td>" ;

            echo "</tr>";
        }

        echo "</table>";
        echo "<div><a href='admin_page.php'>Back</a></div>";
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }

    die; 
}
?>


</body>
</html>




