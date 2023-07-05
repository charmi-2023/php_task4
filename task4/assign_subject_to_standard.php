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
    
    // Get the selected standard and subjects from the form
    $standardId = $_POST['standard'];
    $selectedSubjects = $_POST['subjects'];

    // Assign the subjects to the standard
    foreach ($selectedSubjects as $subjectId) {
        $sql = "INSERT INTO standard_subject (stand_id, sub_id) VALUES ('$standardId', '$subjectId')";
        $result = $conn->query($sql);
        if (!$result) {
            echo 'Error assigning subject: ' . $conn->error;
        }
    }
    header('Location: assign_subject_to_standard.php?success=1');
    exit;
}

// Fetch the standards
$standards = [];
$sql = 'SELECT * FROM standard';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $standards[$row['stand_id']] = $row['standards'];
    }
}

// Fetch the subjects
$subjects = [];
$sql = 'SELECT * FROM subject';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subjects[$row['sub_id']] = $row['sub_name'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Subjects</title>
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
    <h1>Assign Subjects to Standards</h1>

    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<p>Subjects assigned successfully!</p>';
    }
    ?>

    <form method="POST" action="assign_subject_to_standard.php">
        <label for="standard">Standard:</label>
        <select name="standard" id="standard" required>
            <option value="">Select a standard</option>
            <?php
            // Display the standards in the dropdown
            foreach ($standards as $standardId => $standardName) {
                echo '<option value="' . $standardId . '">' . $standardName . '</option>';
            }
            ?>
        </select>
        <br>

        <label for="subjects">Subjects:</label>
        
            <?php
            // Display the subjects as checkboxes
            foreach ($subjects as $subjectId => $subjectName) {
                echo '<div><input type="checkbox" name="chapters[]" value="' . $subjectId . '"> ' . $subjectName . '</div>';
            }
            ?>
        </select>
        <br>

        <button type="submit">Assign</button><br><br>
        <a href="admin_page.php">Go Back</a>
    </form>

    

</body>
</html>
<?php
}
?>