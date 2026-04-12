<?php
session_start();

/* DB CONNECTION */
$conn = new mysqli("localhost", "root", "", "mathquest");

if ($conn->connect_error) {
    die("DB Error");
}

/* LOGIN CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../SignIn.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* GET SCORE (from session or GET) */
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

/* OPTIONAL: UPDATE POINTS */
$conn->query("UPDATE users SET points = points + $score WHERE user_id=$user_id");

/* GET USER */
$user = $conn->query("SELECT username, points FROM users WHERE user_id=$user_id")->fetch_assoc();

/* RESULT MESSAGE */
if ($score >= 80) {
    $message = "🏆 Excellent!";
} elseif ($score >= 50) {
    $message = "👍 Good Job!";
} else {
    $message = "😅 Try Again!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Quiz Result</title>

<style>
body {
    margin:0;
    font-family:'Poppins', sans-serif;
    background: linear-gradient(135deg, #43cea2, #185a9d);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

/* MAIN BOX */
.container {
    background:white;
    padding:50px;
    border-radius:20px;
    text-align:center;
    width:500px;
    box-shadow:0 15px 40px rgba(0,0,0,0.3);
    animation: pop 0.5s ease;
}

/* ANIMATION */
@keyframes pop {
    0% { transform: scale(0.7); opacity:0; }
    100% { transform: scale(1); opacity:1; }
}

h1 {
    margin-bottom:10px;
}

/* SCORE */
.score {
    font-size:50px;
    font-weight:bold;
    color:#4CAF50;
    margin:20px 0;
}

/* MESSAGE */
.message {
    font-size:20px;
    margin-bottom:20px;
}

/* USER INFO */
.user {
    margin-bottom:20px;
    color:#555;
}

/* BUTTON */
.btn {
    display:inline-block;
    margin:10px;
    padding:12px 25px;
    background:#4CAF50;
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover {
    background:#388E3C;
    transform:scale(1.05);
}
</style>
</head>

<body>

<div class="container">

<h1>🎯 Quiz Result</h1>

<div class="user">
Hello <?php echo htmlspecialchars($user['username']); ?>
</div>

<div class="score">
<?php echo $score; ?> Points
</div>

<div class="message">
<?php echo $message; ?>
</div>

<a href="quiz.php" class="btn">Play Again</a>
<a href="Dashboard.php" class="btn">Dashboard</a>

</div>

</body>
</html>