<?php
session_start();
include 'db.php';

$result = $conn->query("SELECT * FROM challenges");
?>

<!DOCTYPE html>
<html>
<head>
<title>Game Challenges</title>

<style>
body {
    margin:0;
    font-family:Poppins;
    background: radial-gradient(circle at top,#1a1a2e,#16213e);
    color:white;
}

/* HEADER */
.header {
    text-align:center;
    padding:30px;
}

.header h1 {
    margin:0;
    font-size:2.5em;
}

.header p {
    color:#aaa;
}

/* GRID */
.grid {
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
    padding:30px;
}

/* CARD */
.card {
    background: linear-gradient(145deg,#ffffff,#e6e6e6);
    color:black;
    padding:20px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.4);
    transition:0.3s;
    position:relative;
}

.card:hover {
    transform:translateY(-8px) scale(1.03);
}

/* TITLE */
.card h3 {
    margin:0 0 10px;
}

/* DESC */
.desc {
    font-size:0.9em;
    color:#555;
}

/* BADGE */
.badge {
    position:absolute;
    top:15px;
    right:15px;
    background:gold;
    padding:5px 10px;
    border-radius:10px;
    font-size:0.8em;
}

/* PROGRESS BAR */
.progress-bar {
    height:8px;
    background:#ddd;
    border-radius:10px;
    margin-top:10px;
}

.progress-fill {
    height:100%;
    background:#4CAF50;
    border-radius:10px;
}

/* BUTTON */
.btn {
    margin-top:15px;
    padding:10px;
    width:100%;
    border:none;
    border-radius:10px;
    font-weight:bold;
}

.done {
    background:#aaa;
}

.active {
    background:#ff9800;
    color:white;
}

/* BACK */
.back {
    display:block;
    text-align:center;
    margin:20px;
    color:white;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="header">
    <h1>🎯 Game Challenges</h1>
    <p>Complete tasks and earn XP!</p>
</div>

<div class="grid">

<?php
while($row = $result->fetch_assoc()) {

    $cid = $row['challenge_id'];
    $title = $row['title'];
    $desc = $row['description'];
    $points = $row['reward_points'];

    $isDone = false;

    if (isset($_SESSION['completed_challenges'])) {
        if (in_array($cid, $_SESSION['completed_challenges'])) {
            $isDone = true;
        }
    }

    echo "<div class='card'>
            <div class='badge'>⭐ $points XP</div>
            <h3>$title</h3>
            <p class='desc'>$desc</p>";

    if ($isDone) {
        echo "
        <div class='progress-bar'>
            <div class='progress-fill' style='width:100%'></div>
        </div>
        <button class='btn done'>✅ Completed</button>
        ";
    } else {
        echo "
        <div class='progress-bar'>
            <div class='progress-fill' style='width:30%'></div>
        </div>
        <button class='btn active'>⏳ In Progress</button>
        ";
    }

    echo "</div>";
}
?>

</div>

<a href="dashboard.php" class="back">⬅ Back to Dashboard</a>

</body>
</html>