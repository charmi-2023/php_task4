<?php
session_start();
if(!(isset($_SESSION['log_in'])) || $_SESSION['log_in']!==true){
   header("location:login_form.php");
}
else{


?>



<?php
include 'config.php';

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected subject and chapters from the form
    $subjectId = $_POST['subject'];
    $selectedChapters = $_POST['chapters'];

    // Assign the chapters to the subject
    foreach ($selectedChapters as $chapterId) {
        $sql = "INSERT INTO subject_chapter (sub_id, chap_id) VALUES ('$subjectId', '$chapterId')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo 'Error assigning chapter: ' . mysqli_error($conn);
        }
    }

    header('Location: assign_chapter.php?success=1');
    exit;
}

// Fetch the subjects
$subjects = [];
$sql = 'SELECT * FROM subject';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[$row['sub_id']] = $row['sub_name'];
    }
}

// Fetch the chapters
$chapters = [];
$sql = 'SELECT * FROM chapter';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $chapters[$row['chap_id']] = $row['chap_name'];
    }
}

// Fetch the assigned chapters for display
$assignedChapters = [];
$sql = 'SELECT sc.*, s.sub_name, c.chap_name FROM subject_chapter sc
        INNER JOIN subject s ON sc.sub_id = s.sub_id
        INNER JOIN chapter c ON sc.chap_id = c.chap_id';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $assignedChapters[] = $row;
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Chapters</title>

    <style>
        body {
            background-color: #FFFAFA;
            color: #FF4081;
            font-family: Arial, sans-serif;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        select,
        input[type="checkbox"],
        button {
            margin-top: 5px;
        }

        button {
            padding: 8px 16px;
            background-color: #FF4081;
            color: #FFFFFF;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #FF80AB;
        }

        a {
            color: #FF4081;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 50%;
            
        }

        table td,
        table th {
            padding: 8px;
            border: 1px solid #FF4081;
            text-align: left;
        }

        table th {
            background-color: #FF4081;
            color: #FFFFFF;
        }
    </style>

</head>
<body>
    <h1>Assign Chapters</h1>

    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<p>Chapters assigned successfully!</p>';
    }
    ?>

    <form method="POST" action="assign_chapter.php">
        <label for="subject">Subject:</label>
        <select name="subject" id="subject" required>
            <option value="">Select a subject</option>
            <?php
            // Display the subjects in the dropdown
            foreach ($subjects as $subjectId => $subjectName) {
                echo '<option value="' . $subjectId . '">' . $subjectName . '</option>';
            }
            ?>
        </select>
        <br>

        <label for="chapters">Chapters:</label>
        <?php
        // Display the chapters as checkboxes
        foreach ($chapters as $chapterId => $chapterName) {
            echo '<div><input type="checkbox" name="chapters[]" value="' . $chapterId . '"> ' . $chapterName . '</div>';
        }
        ?>
        <br>

        <button type="submit">Assign</button><br><br>
        <a href="admin_page.php">Go Back</a>
    </form>

    <?php
    // Display the assigned chapters in a table
    if (!empty($assignedChapters)) {
        echo '<h2>Assigned Chapters</h2>';
        echo '<table>';
        echo '<tr><th>Subject</th><th>Chapter</th></tr>';
        foreach ($assignedChapters as $chapter) {
            echo '<tr>';
            echo '<td>' . $chapter['sub_name'] . '</td>';
            echo '<td>' . $chapter['chap_name'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
</body>
</html>

<?php
}
?>