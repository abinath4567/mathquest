<?php
session_start();

/* DB CONNECTION (safe) */
$conn = new mysqli("localhost", "root", "", "mathquest");

if ($conn->connect_error) {
    die("DB Error");
}

/* GET USERS SORTED BY POINTS */
$result = $conn->query("SELECT username, points FROM users ORDER BY points DESC");

$players = [];
while($row = $result->fetch_assoc()){
    $players[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>

<style>
body {
    margin:0;
    font-family:'Poppins', sans-serif;
    background: linear-gradient(135deg,#667eea,#764ba2);
    color:white;
}

/* TITLE */
h1{
    text-align:center;
    margin-top:30px;
    font-size:2.5em;
}

/* PODIUM */
.podium{
    display:flex;
    justify-content:center;
    align-items:flex-end;
    gap:20px;
    margin:40px 0;
}

.podium .card{
    width:150px;
    text-align:center;
    border-radius:15px;
    padding:20px;
    color:black;
    font-weight:bold;
    animation: pop 0.6s ease;
}

@keyframes pop{
    from{transform:scale(0);}
    to{transform:scale(1);}
}

.first{
    background: gold;
    height:200px;
    box-shadow:0 0 20px gold;
}

.second{
    background: silver;
    height:160px;
}

.third{
    background:#cd7f32;
    height:140px;
}

.name{
    margin-top:10px;
}

.points{
    font-size:1.2em;
}

/* TABLE */
.table-box{
    background:white;
    color:black;
    width:800px;
    margin:30px auto;
    border-radius:20px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#333;
    color:white;
    padding:15px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f9f9f9;
}

/* CURRENT USER HIGHLIGHT */
.me{
    background:#d4edda !important;
    font-weight:bold;
}

/* BACK BUTTON */
.back{
    display:block;
    width:200px;
    margin:30px auto;
    text-align:center;
    padding:12px;
    background:#222;
    color:white;
    border-radius:10px;
    text-decoration:none;
}

.back:hover{
    background:black;
}
</style>
</head>

<body>

<h1>🏆 Leaderboard</h1>

<!-- PODIUM TOP 3 -->
<div class="podium">

<?php if(isset($players[1])){ ?>
<div class="card second">
    🥈
    <div class="name"><?php echo $players[1]['username']; ?></div>
    <div class="points"><?php echo $players[1]['points']; ?></div>
</div>
<?php } ?>

<?php if(isset($players[0])){ ?>
<div class="card first">
    🥇
    <div class="name"><?php echo $players[0]['username']; ?></div>
    <div class="points"><?php echo $players[0]['points']; ?></div>
</div>
<?php } ?>

<?php if(isset($players[2])){ ?>
<div class="card third">
    🥉
    <div class="name"><?php echo $players[2]['username']; ?></div>
    <div class="points"><?php echo $players[2]['points']; ?></div>
</div>
<?php } ?>

</div>

<!-- FULL TABLE -->
<div class="table-box">

<table>
<tr>
    <th>#</th>
    <th>Username</th>
    <th>Points</th>
</tr>

<?php
$rank = 1;
$currentUser = $_SESSION['username'] ?? "";

foreach($players as $row){

    $highlight = ($row['username'] == $currentUser) ? "me" : "";

    echo "<tr class='$highlight'>
            <td>$rank</td>
            <td>{$row['username']}</td>
            <td>{$row['points']}</td>
          </tr>";

    $rank++;
}
?>

</table>

</div>

<a href="Dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>