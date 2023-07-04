<?php
include 'config.php';

function getAllStandards()
{
    global $conn;
    $query = "SELECT * FROM standard";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if (isset($_POST['standard_submit'])) {
    // Add standard
    if ($_POST['action'] === 'add_standard') {
        $standardName = $_POST['standard_name'];
        $query = "INSERT INTO standard (standards) VALUES ('$standardName')";
        mysqli_query($conn, $query);
    }
    // Edit standard
    elseif ($_POST['action'] === 'edit_standard') {
        $standardId = $_POST['stand_id'];
        $newStandardName = $_POST['new_standard_name'];
        $query = "UPDATE standard SET standards='$newStandardName' WHERE stand_id=$standardId";
        mysqli_query($conn, $query);
    }
    // Delete standard
    elseif ($_POST['action'] === 'delete_standard') {
        $standardId = $_POST['stand_id'];
        $query = "DELETE FROM standard WHERE stand_id=$standardId";
        mysqli_query($conn, $query);
    }
}

$standards = getAllStandards();
?>

<!-- HTML Form for Add/Edit/Delete Standard Section -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  

  <style>

   * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
   }
  
   body {
     font-family: Arial, sans-serif;
   }
   
   .body{
    margin: 0px 300px;
   }
  
   h2 {
     margin: 20px 0;
     font-size: 24px;
   }
  
   table {
     border-collapse: collapse;
     width: 100%;
   }
  
   th, td {
     padding: 8px;
     text-align: left;
     border-bottom: 1px solid #ddd;
   }
  
   th {
     background-color: #f2f2f2;
   }
  
   form {
     display: inline-block;
   }
  
   input[type="text"] {
     padding: 4px;
     margin-right: 4px;
   }
  
   button {
     padding: 4px 8px;
     background-color: #FF4081;
     color: white;
     border: none;
     cursor: pointer;
     border-radius: 4px;
   }
  
   button:hover {
     background-color: #FF80AB; 
   }
  
   a {
     display: inline-block;
     margin-top: 10px;
     color: #FF4081;
     text-decoration: none;
   }
  
   a:hover {
     text-decoration: underline;
   }
  
   .container {
     max-width: 800px;
     margin: 0 auto;
     padding: 20px;
     background-color: #FFFAFA; 
   }
 </style>
</head>
        <body>

        <div class="body">
        <h2>Add/Edit/Delete Standards</h2>



<table>
    <thead>
        <tr>
            <th>Standard ID</th>
            <th>Standard Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($standards as $standard) { ?>
            <tr>
                <td><?php echo $standard['stand_id']; ?></td>
                <td><?php echo $standard['standards']; ?></td>
                <td>
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="action" value="edit_standard">
                        <input type="text" name="new_standard_name" placeholder="New Standard Name" required>
                        <input type="hidden" name="stand_id" value="<?php echo $standard['stand_id']; ?>">
                        <button type="submit" name="standard_submit">Edit</button>
                    </form>
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="action" value="delete_standard">
                        <input type="hidden" name="stand_id" value="<?php echo $standard['stand_id']; ?>">
                        <button type="submit" name="standard_submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Form to add a new standard -->
<h3>Add Standard</h3>
<form method="post">
    <input type="hidden" name="action" value="add_standard">
    <input type="text" name="standard_name" placeholder="Standard Name" required>
    <button type="submit" name="standard_submit">Add Standard</button>
</form>

<div><a href='admin_page.php'>Go Back</a></div>
        </div>
        </body>
        </html>