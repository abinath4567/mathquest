<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$conn = mysqli_connect("localhost", "root", "", "mathquest");

mysqli_query($conn, "INSERT INTO rewards (name, points_required) VALUES
('First Step Explorer', 100),
('Rising Rookie', 300),
('Ultimate Legend', 1000)");

echo "Data inserted!";
?>
