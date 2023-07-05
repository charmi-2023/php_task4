<?php
session_start();
if(!(isset($_SESSION['log_in'])) || $_SESSION['log_in']!==true){
   header("location:login_form.php");
}
else{

?>

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
  <link rel="stylesheet" href="sections.css">

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

<?php
}
?>





