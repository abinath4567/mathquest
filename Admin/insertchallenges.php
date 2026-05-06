<!DOCTYPE html>
<html>
<head>
    <title>MathQuest Challenges</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f7971e, #ffd200);
            margin: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: white;
            margin-top: 30px;
        }

        .container {
            width: 380px;
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
            background: #f7971e;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #e68612;
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
            background: #f7971e;
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

<h1>🧠 MathQuest Challenges</h1>

<div class="container">
    <h3>Add New Challenge</h3>

    <form onsubmit="addChallenge(event)">
        <input type="text" id="title" placeholder="Challenge title (e.g. Algebra Sprint)" required>
        <input type="text" id="question" placeholder="Question (e.g. 5x + 2 = 12)" required>
        <input type="number" id="reward" placeholder="Reward points" required>
        <button type="submit">Add Challenge</button>
    </form>
</div>

<table id="challengeTable">
    <tr>
        <th>ID</th>
        <th>Challenge</th>
        <th>Question</th>
        <th>Reward</th>
    </tr>

    <!-- Preloaded Challenges -->
    <tr><td>1</td><td>➕ Quick Addition Sprint</td><td>12 + 8 = ?</td><td>10</td></tr>
    <tr><td>2</td><td>✖️ Multiplication Master</td><td>7 × 6 = ?</td><td>20</td></tr>
    <tr><td>3</td><td>➗ Division Dash</td><td>81 ÷ 9 = ?</td><td>25</td></tr>
    <tr><td>4</td><td>📐 Geometry Challenge</td><td>Area of square with side 5?</td><td>30</td></tr>
    <tr><td>5</td><td>🧩 Algebra Puzzle</td><td>2x + 3 = 11, find x</td><td>40</td></tr>
</table>

<script>
let challengeId = 6;

function addChallenge(event) {
    event.preventDefault();

    let title = document.getElementById("title").value;
    let question = document.getElementById("question").value;
    let reward = document.getElementById("reward").value;

    let table = document.getElementById("challengeTable");
    let row = table.insertRow();

    row.insertCell(0).innerText = challengeId++;
    row.insertCell(1).innerText = title;
    row.insertCell(2).innerText = question;
    row.insertCell(3).innerText = reward;

    document.querySelector("form").reset();
}
</script>

</body>
</html>
