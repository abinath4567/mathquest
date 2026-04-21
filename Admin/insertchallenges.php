<?php
$conn = mysqli_connect("localhost", "root", "", "mathquest");

mysqli_query($conn, "INSERT INTO challenges (title, points) VALUES
('Easy Quiz', 50),
('Hard Quiz', 100)");

echo "Data inserted!";
?>
