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
    <title>MathQuest Students</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #43cea2, #185a9d);
            margin: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: white;
            margin-top: 30px;
        }

        .container {
            width: 350px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #185a9d;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #144a80;
        }

        table {
            width: 85%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #185a9d;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>🎓 MathQuest Students</h1>

<a href="dashboard.php" style="display: block; margin-bottom: 20px; color: #185a9d; text-decoration: none;">← Back to Dashboard</a>

<div class="container">
    <h3>Add New Student</h3>

    <form onsubmit="addStudent(event)">
        <input type="text" id="name" placeholder="Student name" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="number" id="points" placeholder="Points" value="0">
        <button type="submit">Add Student</button>
    </form>
</div>

<table id="studentTable">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Points</th>
    </tr>

    <!-- Preloaded Students -->
    <tr><td>1</td><td>Ali</td><td>ali@email.com</td><td>120</td></tr>
    <tr><td>2</td><td>Siti</td><td>siti@email.com</td><td>95</td></tr>
    <tr><td>3</td><td>Jason</td><td>jason@email.com</td><td>150</td></tr>
    <tr><td>4</td><td>Aina</td><td>aina@email.com</td><td>80</td></tr>
    <tr><td>5</td><td>Kumar</td><td>kumar@email.com</td><td>110</td></tr>
</table>

<script>
let studentId = 6;

function addStudent(event) {
    event.preventDefault();

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let points = document.getElementById("points").value;

    let table = document.getElementById("studentTable");
    let row = table.insertRow();

    row.insertCell(0).innerText = studentId++;
    row.insertCell(1).innerText = name;
    row.insertCell(2).innerText = email;
    row.insertCell(3).innerText = points;

    document.querySelector("form").reset();
}
</script>

</body>
</html>
