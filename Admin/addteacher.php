<?php

$conn = mysqli_connect("localhost", "root", "", "mathquest");


if (!$conn) {
    die("Connection failed");
}


$sql1 = "CREATE TABLE teachers (
    teacher_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE
)";


$sql2 = "INSERT INTO teachers (name, email) VALUES
('Sivakumaran', 'Sivakumaran6767@mail.edu.apu.my'),
('Govindamal', 'Govindamal9696@mail.edu.apu.my')";


mysqli_query($conn, $sql1);


mysqli_query($conn, $sql2);


echo "Teachers table created and data inserted!";


mysqli_close($conn);
?>
