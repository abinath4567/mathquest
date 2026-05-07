<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$conn = mysqli_connect("localhost", "root", "", "mathquest");
mysqli_query($conn, "INSERT INTO students (name, points) VALUES
('Abinath', 200),
('Govind Raj', 500),
('Brian Chew', 800)");

echo "Data inserted!";
?>
