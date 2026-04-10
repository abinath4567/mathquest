<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username, points FROM users WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>MathQuest Dashboard</title>

<style>
body {
    margin: 0;
    font-family: 'Comic Sans MS', cursive;
    overflow: hidden;
    background: linear-gradient(135deg, #ffecd2, #fcb69f);
}

/* FLOATING NUMBERS */
.number {
    position: absolute;
    font-size: 40px;
    font-weight: bold;
    opacity: 0.2;
    animation: float 10s infinite linear;
}

@keyframes float {
    0% { transform: translateY(100vh); }
    100% { transform: translateY(-10vh); }
}

/* HEADER */
.header {
    text-align: center;
    padding: 30px;
    color: #333;
}

.header h1 {
    font-size: 2.5em;
}

/* CARD */
.container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 30px;
}

/* BUTTON CARDS */
.card {
    width: 200px;
    height: 140px;
    border-radius: 20px;
    text-align: center;
    padding-top: 40px;
    font-size: 1.3em;
    font-weight: bold;
    color: white;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.card:hover {
    transform: scale(1.1) rotate(2deg);
}

/* COLORS */
.quiz { background: #ff6b6b; }
.challenge { background: #4ecdc4; }
.leaderboard { background: #ffe66d; color:black; }
.result { background: #6a89cc; }

/* POINTS */
.points {
    margin-top: 10px;
    font-size: 1.2em;
    color: #444;
}
</style>

</head>

<body>

<!-- FLOATING NUMBERS -->
<div class="number" style="left:10%; animation-duration:12s;">1</div>
<div class="number" style="left:30%; animation-duration:15s;">2</div>
<div class="number" style="left:50%; animation-duration:10s;">3</div>
<div class="number" style="left:70%; animation-duration:18s;">4</div>
<div class="number" style="left:85%; animation-duration:14s;">5</div>

<div class="header">
    <h1>Hi <?php echo $data['username']; ?> 👋</h1>
    <div class="points">⭐ Points: <?php echo $data['points']; ?></div>
</div>

<div class="container">

<a href="Quiz.php" class="card quiz">
🎮 Play Quiz
</a>

<a href="Challenge.php" class="card challenge">
⚔️ Challenge
</a>

<a href="Leaderboard.php" class="card leaderboard">
🏆 Leaderboard
</a>

<a href="Result.php" class="card result">
📊 My Score
</a>

</div>

</body>
</html>