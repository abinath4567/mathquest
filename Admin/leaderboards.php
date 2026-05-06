<!DOCTYPE html>
<html>
<head>
    <title>MathQuest Leaderboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #11998e, #38ef7d);
            margin: 0;
        }

        h1 {
            text-align: center;
            color: white;
            margin-top: 30px;
        }

        .container {
            width: 400px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #11998e;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #0f7f75;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #11998e;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(1) {
            background: gold;
            font-weight: bold;
        }

        tr:nth-child(2) {
            background: silver;
        }

        tr:nth-child(3) {
            background: #cd7f32;
        }
    </style>
</head>
<body>

<h1>🏆 MathQuest Leaderboard</h1>

<div class="container">
    <h3>Add / Update Student Score</h3>

    <form onsubmit="addScore(event)">
        <input type="text" id="name" placeholder="Student name" required>
        <input type="number" id="score" placeholder="Score / Points" required>
        <button type="submit">Update Leaderboard</button>
    </form>
</div>

<table id="leaderboard">
    <tr>
        <th>Rank</th>
        <th>Name</th>
        <th>Score</th>
    </tr>

    <!-- Preloaded leaderboard -->
    <tr><td>1 🥇</td><td>Ali</td><td>150</td></tr>
    <tr><td>2 🥈</td><td>Jason</td><td>130</td></tr>
    <tr><td>3 🥉</td><td>Siti</td><td>120</td></tr>
</table>

<script>
function addScore(event) {
    event.preventDefault();

    let name = document.getElementById("name").value;
    let score = document.getElementById("score").value;

    let table = document.getElementById("leaderboard");
    let row = table.insertRow();

    row.insertCell(0).innerText = "-";
    row.insertCell(1).innerText = name;
    row.insertCell(2).innerText = score;

    document.querySelector("form").reset();
}
</script>

</body>
</html>
