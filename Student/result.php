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
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg,#141e30,#243b55);
    margin:0;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
}

/* RESULT CARD */
.card {
    background:white;
    color:black;
    width:400px;
    padding:50px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 15px 40px rgba(0,0,0,0.4);
    animation: pop 0.5s ease;
}

/* POP ANIMATION */
@keyframes pop {
    0% {transform:scale(0.7); opacity:0;}
    100% {transform:scale(1); opacity:1;}
}

/* TITLE */
h2 {
    margin-bottom:10px;
}

/* SCORE */
.score {
    font-size:60px;
    font-weight:bold;
    color:#4CAF50;
    margin:20px 0;
}

/* MESSAGE */
.message {
    font-size:18px;
    margin-bottom:25px;
    color:#555;
}

/* BUTTON */
.btn {
    display:inline-block;
    padding:12px 25px;
    margin:8px;
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

/* SECOND BUTTON */
.btn-secondary {
    background:#333;
}

.btn-secondary:hover {
    background:black;
}
</style>
</head>

<body>

<div class="card">

<h2>🎯 Game Over</h2>

<div class="score"><?php echo $score; ?></div>

<div class="message">
<?php 
if($score >= 80) echo "🏆 Excellent!";
elseif($score >= 50) echo "👍 Good Job!";
else echo "😅 Try Again!";
?>
</div>

<a href="Quiz.php" class="btn">Play Again</a>
<a href="Dashboard.php" class="btn btn-secondary">Back to Dashboard</a>

</div>

</body>
</html>

<?php
unset($_SESSION['score'],$_SESSION['q_index'],$_SESSION['level'],$_SESSION['questions']);
?>