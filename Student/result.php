<?php
include 'db.php';
session_start();

$score = $_SESSION['score'] ?? 0;
$user = $_SESSION['user_id'];

$stmt = $conn->prepare("UPDATE users SET points = points + ? WHERE user_id=?");
$stmt->bind_param("ii",$score,$user);
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family:Poppins;
    background: linear-gradient(135deg,#141e30,#243b55);
    color:white;
    text-align:center;
}

.card {
    background:white;
    color:black;
    width:350px;
    margin:100px auto;
    padding:40px;
    border-radius:20px;
}

.score {
    font-size:2em;
    color:#4CAF50;
}
</style>
</head>

<body>

<div class="card">
<h2>Game Over</h2>
<div class="score"><?php echo $score; ?></div>

<a href="Quiz.php">Play Again</a><br><br>
<a href="Dashboard.php">Back</a>
</div>

</body>
</html>

<?php
unset($_SESSION['score'],$_SESSION['q_index'],$_SESSION['level'],$_SESSION['questions']);
?>