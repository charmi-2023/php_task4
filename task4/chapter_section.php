<?php
include 'config.php';

function getAllChapters()
{
   global $conn;
   $query = "SELECT * FROM chapter";
   $result = mysqli_query($conn, $query);
   return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if (isset($_POST['chapter_submit'])) {
   // Add chapter
   if ($_POST['action'] === 'add_chapter') {
       $chapterName = $_POST['chapter_name'];
       $query = "INSERT INTO chapter (chap_name) VALUES ('$chapterName')";
       mysqli_query($conn, $query);
   }
   // Edit chapter
   elseif ($_POST['action'] === 'edit_chapter') {
       $chapterId = $_POST['chap_id'];
       $newChapterName = $_POST['new_chapter_name'];
       $query = "UPDATE chapter SET chap_name='$newChapterName' WHERE chap_id=$chapterId";
       mysqli_query($conn, $query);
   }
   // Delete chapter
   elseif ($_POST['action'] === 'delete_chapter') {
       $chapterId = $_POST['chap_id'];
       $query = "DELETE FROM chapter WHERE chap_id=$chapterId";
       mysqli_query($conn, $query);
   }
}

$chapters = getAllChapters();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page - Manage Chapters</title>
  <style>
   * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
   }
  
   body {
     font-family: Arial, sans-serif;
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
<div class="container">
  <h2>Add/Edit/Delete Chapters</h2>
  <table>
    <thead>
    <tr>
      <th>Chapter ID</th>
      <th>Chapter Name</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($chapters as $chapter) { ?>
      <tr>
        <td><?php echo $chapter['chap_id']; ?></td>
        <td><?php echo $chapter['chap_name']; ?></td>
<td>
<form method="post">
<input type="hidden" name="action" value="edit_chapter">
<input type="text" name="new_chapter_name" placeholder="New Chapter Name" required>
<input type="hidden" name="chap_id" value="<?php echo $chapter['chap_id']; ?>">
<button type="submit" name="chapter_submit">Edit</button>
</form>
<form method="post">
<input type="hidden" name="action" value="delete_chapter">
<input type="hidden" name="chap_id" value="<?php echo $chapter['chap_id']; ?>">
<button type="submit" name="chapter_submit">Delete</button>
</form>
</td>
</tr>
<?php } ?>
</tbody>

  </table>
  <h3>Add Chapter</h3>
  <form method="post">
    <input type="hidden" name="action" value="add_chapter">
    <input type="text" name="chapter_name" placeholder="Chapter Name" required>
    <button type="submit" name="chapter_submit">Add Chapter</button>
  </form>
  
<a href="admin_page.php">Go Back</a>

</div>
</body>
</html>






