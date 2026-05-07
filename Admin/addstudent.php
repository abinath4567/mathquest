<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "mathquest");


if (!$conn) {
    die("Connection failed");
}


$sql = "CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    email VARCHAR(50),
    point INT DEFAULT 0
)";


if (mysqli_query($conn, $sql)) {
    echo "Students table created!";
} else {
    echo "Error creating table";
}


mysqli_close($conn);
?>
