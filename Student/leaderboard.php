<?php
session_start();

/* DB CONNECTION (safe) */
$conn = new mysqli("localhost", "root", "", "mathquest");

if ($conn->connect_error) {
    die("DB Error");
}

/* GET USERS SORTED BY POINTS */
$result = $conn->query("SELECT username, points FROM users ORDER BY points DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>

<style>
body {
    margin:0;
    font-family:'Poppins', sans-serif;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4);
}

/* MAIN */
.container {
    max-width: 900px;
    margin: 50px auto;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    text-align: center;
}

h1 {
    margin-bottom: 20px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 18px;
}

th {
    background: #333;
    color: white;
    padding: 15px;
}

td {
    padding: 15px;
    border-bottom: 1px solid #eee;
}

/* HOVER */
tr:hover {
    background: #f5f5f5;
}

/* TOP 3 STYLES */
.rank-1 {
    background: #fff3cd !important;
    font-weight: bold;
}

.rank-2 {
    background: #e2e3e5 !important;
}

.rank-3 {
    background: #f8d7da !important;
}

/* BADGE */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    color: white;
    font-weight: bold;
}

.gold { background: gold; color:black; }
.silver { background: silver; color:black; }
.bronze { background: #cd7f32; }

/* BACK BUTTON */
.back {
    margin-top: 30px;
    display: inline-block;
    padding: 12px 25px;
    background: #333;
    color: white;
    text-decoration: none;
    border-radius: 10px;
}

.back:hover {
    background: black;
}
</style>
</head>

<body>

<div class="container">

<h1> Leaderboard</h1>

<table>
<tr>
    <th>Rank</th>
    <th>Username</th>
    <th>Points</th>
</tr>

<?php
$rank = 1;
while($row = $result->fetch_assoc()) {

    $class = "";
    $badge = "";

    if ($rank == 1) {
        $class = "rank-1";
        $badge = "<span class='badge gold'>1</span>";
    } elseif ($rank == 2) {
        $class = "rank-2";
        $badge = "<span class='badge silver'>2</span>";
    } elseif ($rank == 3) {
        $class = "rank-3";
        $badge = "<span class='badge bronze'>3</span>";
    } else {
        $badge = $rank;
    }

    echo "<tr class='$class'>
            <td>$badge</td>
            <td>{$row['username']}</td>
            <td>{$row['points']}</td>
          </tr>";

    $rank++;
}
?>

</table>

<a href="Dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>