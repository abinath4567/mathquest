<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

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
body { font-family:Poppins; text-align:center; background:#e8f5e9; }

.box {
    background:white;
    width:300px;
    margin:100px auto;
    padding:30px;
    border-radius:15px;
}
</style>
</head>

<body>

<div class="box">
<h2>Quiz Finished</h2>
<p>Your Score: <?php echo $score; ?></p>

<a href="Dashboard.php">Back</a>
</div>

</body>
</html>

<?php
unset($_SESSION['score'],$_SESSION['q_index'],$_SESSION['level'],$_SESSION['questions']);
?>