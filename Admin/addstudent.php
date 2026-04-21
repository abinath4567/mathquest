x<?php
// 1. Connect to database
$conn = mysqli_connect("localhost", "root", "", "mathquest");

// 2. Check connection
if (!$conn) {
    die("Connection failed");
}

// 3. SQL to create table
$sql = "CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    email VARCHAR(50),
    point INT DEFAULT 0
)";

// 4. Run the SQL
if (mysqli_query($conn, $sql)) {
    echo "Students table created!";
} else {
    echo "Error creating table";
}

// 5. Close connection
mysqli_close($conn);
?>