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
    <title>MathQuest Rewards</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
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
            background: #0072ff;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #005edb;
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
            background: #0072ff;
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

<h1>📐 MathQuest Rewards</h1>

<a href="dashboard.php" style="display: block; margin-bottom: 20px; color: #185a9d; text-decoration: none;">← Back to Dashboard</a>

<div class="container">
    <h3>Add New Reward</h3>

    <form onsubmit="addReward(event)">
        <input type="text" id="rewardName" placeholder="Reward name" required>
        <input type="number" id="points" placeholder="Points required" required>
        <button type="submit">Add Reward</button>
    </form>
</div>

<table id="rewardTable">
    <tr>
        <th>ID</th>
        <th>Reward</th>
        <th>Points</th>
    </tr>

    <!-- Math-Themed Rewards -->
    <tr><td>1</td><td>➕ Bonus Point Boost</td><td>20</td></tr>
    <tr><td>2</td><td>🧠 Genius Mode Unlock</td><td>100</td></tr>
    <tr><td>3</td><td>📊 Double XP (Solve Faster)</td><td>80</td></tr>
    <tr><td>4</td><td>📝 Skip One Question Pass</td><td>50</td></tr>
    <tr><td>5</td><td>⏱️ Extra Time Token</td><td>40</td></tr>
    <tr><td>6</td><td>🎯 Perfect Score Badge</td><td>120</td></tr>
    <tr><td>7</td><td>🔢 Hint Unlock (Next Question)</td><td>30</td></tr>
</table>

<script>
let rewardId = 8;

function addReward(event) {
    event.preventDefault();

    let name = document.getElementById("rewardName").value;
    let points = document.getElementById("points").value;

    let table = document.getElementById("rewardTable");
    let row = table.insertRow();

    row.insertCell(0).innerText = rewardId++;
    row.insertCell(1).innerText = name;
    row.insertCell(2).innerText = points;

    document.querySelector("form").reset();
}
</script>

</body>
</html>
