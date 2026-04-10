<?php
session_start();

if (!isset($_SESSION['user_score'])) {
    $_SESSION['user_score']=0;
    $_SESSION['bot_score']=0;
}

if (isset($_POST['answer'])) {

    $correct = 8;

    if ($_POST['answer']==$correct) {
        $_SESSION['user_score']+=10;
    }

    if (rand(0,1)) {
        $_SESSION['bot_score']+=10;
    }
}
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

button {
    padding:10px 20px;
    margin:10px;
    background:#4CAF50;
    color:white;
    border:none;
    border-radius:8px;
}
</style>
</head>

<body>

<div class="box">

<h2>1 vs Computer</h2>
<p>4 + 4 = ?</p>

<form method="POST">
<button name="answer" value="8">8</button>
<button name="answer" value="6">6</button>
</form>

<p>You: <?php echo $_SESSION['user_score']; ?></p>
<p>Computer: <?php echo $_SESSION['bot_score']; ?></p>

<a href="Dashboard.php">Back</a>

</div>

</body>
</html>