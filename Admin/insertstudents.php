<?php
$conn = mysqli_connect("localhost", "root", "", "mathquest");
mysqli_query($conn, "INSERT INTO students (name, points) VALUES
('Abinath', 200),
('Govind Raj', 500),
('Brian Chew', 800)");

echo "Data inserted!";
?>
