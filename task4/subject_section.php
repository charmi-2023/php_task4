<?php
include 'config.php';

function getAllSubjects()
{
    global $conn;
    $query = "SELECT * FROM subject";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if (isset($_POST['subject_submit'])) {
    // Add subject
    if ($_POST['action'] === 'add_subject') {
        $subjectName = $_POST['subject_name'];
        $query = "INSERT INTO subject (sub_name) VALUES ('$subjectName')";
        mysqli_query($conn, $query);
    }
    // Edit subject
    elseif ($_POST['action'] === 'edit_subject') {
        $subjectId = $_POST['sub_id'];
        $newSubjectName = $_POST['new_subject_name'];
        $query = "UPDATE subject SET sub_name='$newSubjectName' WHERE sub_id=$subjectId";
        mysqli_query($conn, $query);
    }
    // Delete subject
    elseif ($_POST['action'] === 'delete_subject') {
        $subjectId = $_POST['sub_id'];
        $query = "DELETE FROM subject WHERE sub_id=$subjectId";
        mysqli_query($conn, $query);
    }
}

$subjects = getAllSubjects();
?>

<!-- HTML Form for Add/Edit/Delete Subject Section -->

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
          <h2>Add/Edit/Delete Subjects</h2>

<table>
    <thead>
        <tr>
            <th>Subject ID</th>
            <th>Subject Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($subjects as $subject) { ?>
            <tr>
                <td><?php echo $subject['sub_id']; ?></td>
                <td><?php echo $subject['sub_name']; ?></td>
                <td>
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="action" value="edit_subject">
                        <input type="text" name="new_subject_name" placeholder="New Subject Name" required>
                        <input type="hidden" name="sub_id" value="<?php echo $subject['sub_id']; ?>">
                        <button type="submit" name="subject_submit">Edit</button>
                    </form>
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="action" value="delete_subject">
                        <input type="hidden" name="sub_id" value="<?php echo $subject['sub_id']; ?>">
                        <button type="submit" name="subject_submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Form to add a new subject -->
<h3>Add Subject</h3>
<form method="post">
    <input type="hidden" name="action" value="add_subject">
    <input type="text" name="subject_name" placeholder="Subject Name" required>
    <button type="submit" name="subject_submit">Add Subject</button>
</form>

<div><a href='admin_page.php'>Go Back</a></div>

        </div>
        </body>
        </html>