<?php
include 'db.php';
session_start();

$score = $_SESSION['score'] ?? 0;
$user_id = $_SESSION['user_id'];

/* ADD POINTS */
$stmt = $conn->prepare("UPDATE users SET points = points + ? WHERE user_id=?");
$stmt->bind_param("ii",$score,$user_id);
$stmt->execute();

/* GET UPDATED USER DATA */
$res = $conn->query("SELECT username, points FROM users WHERE user_id=$user_id");
$user = $res->fetch_assoc();

$total_points = $user['points'];

/* LEVEL SYSTEM */
$level = floor($total_points / 100) + 1;
$current_xp = $total_points % 100;
$xp_needed = 100;

/* RESULT MESSAGE */
if($score >= 80) $msg = "🏆 Amazing!";
elseif($score >= 50) $msg = "👍 Good Job!";
else $msg = "😅 Try Again!";
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    margin:0;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
}

/* CARD */
.card {
    background:white;
    color:black;
    width:450px;
    padding:50px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,0.5);
    animation: pop 0.5s ease;
}

@keyframes pop {
    from {transform:scale(0.7); opacity:0;}
    to {transform:scale(1); opacity:1;}
}

/* SCORE */
.score {
    font-size:60px;
    color:#4CAF50;
    margin:20px 0;
}

/* LEVEL */
.level {
    font-size:20px;
    margin-top:10px;
    font-weight:bold;
}

/* XP BAR */
.xp-bar {
    width:100%;
    background:#ddd;
    border-radius:20px;
    overflow:hidden;
    margin:15px 0;
}

.xp-fill {
    height:20px;
    background:linear-gradient(135deg,#4CAF50,#2ecc71);
    width: <?php echo ($current_xp / $xp_needed)*100; ?>%;
    transition: width 1s;
}

/* BUTTON */
.btn {
    display:inline-block;
    padding:12px 25px;
    margin:10px;
    background:linear-gradient(135deg,#4CAF50,#2ecc71);
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover {
    transform:scale(1.05);
}

.btn2 {
    background:#333;
}
</style>
</head>

<body>

<div class="card">

<h2>🎯 Game Result</h2>

<div class="score"><?php echo $score; ?></div>

<div><?php echo $msg; ?></div>

<!-- LEVEL -->
<div class="level">Level <?php echo $level; ?></div>

<!-- XP BAR -->
<div class="xp-bar">
    <div class="xp-fill"></div>
</div>

<div><?php echo $current_xp; ?> / <?php echo $xp_needed; ?> XP</div>

<a href="Quiz.php" class="btn">Play Again</a>
<a href="Dashboard.php" class="btn btn2">Dashboard</a>

</div>

</body>
</html>

<?php
unset($_SESSION['score'],$_SESSION['q_index'],$_SESSION['level'],$_SESSION['questions']);
?>