<?php
include "config.php";

// Fetch the list of students from userType table
$studentsQuery = "SELECT userType.user_id, userType.access_type FROM userType
                  WHERE userType.access_type = 'student'";
$studentsResult = $conn->query($studentsQuery);

// Fetch the list of standards
$standardsQuery = "SELECT stand_id, standards FROM standard";
$standardsResult = $conn->query($standardsQuery);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['student'];
    $standardId = $_POST['standard'];

    $insertQuery = "INSERT INTO assigned_standards (student_id, standard_id) 
                    VALUES ('$studentId', '$standardId')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Assignment successful.";
    } else {
        echo "Error assigning student: " . $conn->error;
    }
}

// Fetch the assigned standards for each student
$assignedStandardsQuery = "SELECT userType.user_id, standard.standards
                           FROM userType
                           INNER JOIN assigned_standards ON userType.user_id = assigned_standards.student_id
                           INNER JOIN standard ON assigned_standards.standard_id = standard.stand_id";
$assignedStandardsResult = $conn->query($assignedStandardsQuery);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Students to Standards</title>
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
            width: 20%;
            
        }

        table td,
        table th {
            padding: 8px;
            border: 1px solid #FF4081;
            text-align: left;
        }

        table th {
            background-color: #FF80AB;
            color: #FFFFFF;
        }
        </style>

</head>
<body>
    <h1>Assign Students to Standards</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="student">Select a student:</label>
        <select name="student" id="student">
            <?php
            while ($row = $studentsResult->fetch_assoc()) {
                $userId = $row['user_id'];
                echo "<option value='$userId'>User ID: $userId</option>";
            }
            ?>
        </select>

        <br><br>

        <label for="standard">Select a standard:</label>
        <select name="standard" id="standard">
            <?php
            while ($row = $standardsResult->fetch_assoc()) {
                $standId = $row['stand_id'];
                $standard = $row['standards'];
                echo "<option value='$standId'>$standard</option>";
            }
            ?>
        </select>

        <br><br>

        <input type="submit" value="Assign"><br><br>
        
    </form> 

    <table border="2">
        <thead>
            <tr>
                <th>Student</th>
                <th>ID</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $assignedStandardsResult->fetch_assoc()) {
                $userId = $row['user_id'];
                $assignedStandard = $row['standards'];
                echo "<tr>";
                echo "<td>$userId</td>";
                echo "<td>$assignedStandard</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
<br>
    <a href="admin_page.php">Go Back</a>
</body>
</html>

