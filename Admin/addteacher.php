<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Teacher</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
        }
        .form-container {
            width: 300px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: blue;
            color: white;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Teacher</h2>

    <a href="dashboard.php" style="display: block; margin-bottom: 20px; color: blue; text-decoration: none;">← Back to Dashboard</a>

    <form onsubmit="addTeacher(event)">
        <input type="text" id="name" placeholder="Enter teacher name" required>
        <input type="email" id="email" placeholder="Enter email" required>
        <input type="text" id="subject" placeholder="Enter subject" required>
        <button type="submit">Add Teacher</button>
    </form>
</div>

<table id="teacherTable">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
    </tr>
</table>

<script>
let id = 1;

function addTeacher(event) {
    event.preventDefault();

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let subject = document.getElementById("subject").value;

    let table = document.getElementById("teacherTable");
    let row = table.insertRow();

    row.insertCell(0).innerText = id++;
    row.insertCell(1).innerText = name;
    row.insertCell(2).innerText = email;
    row.insertCell(3).innerText = subject;

    document.querySelector("form").reset();
}
</script>

</body>
</html>
