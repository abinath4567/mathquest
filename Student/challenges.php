<?php
session_start();

if (!isset($_SESSION['user_score'])) {
    $_SESSION['user_score'] = 0;
    $_SESSION['bot_score'] = 0;
}

if (isset($_POST['answer'])) {
    $correct = 12;

    if ($_POST['answer'] == $correct) {
        $_SESSION['user_score'] += 10;
    }

    if (rand(0, 1)) {
        $_SESSION['bot_score'] += 10;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Challenge</title>

<style>
body {
    font-family: Poppins;
    background: #e8f5e9;
    text-align: center;
}

.card {
    background: white;
    width: 350px;
    margin: 80px auto;
    padding: 30px;
    border-radius: 15px;
}

button {
    padding: 12px 20px;
    margin: 10px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #388E3C;
}
</style>
</head>

<body>

<div class="card">

<h2>1 vs Computer</h2>

<p>6 × 2 = ?</p>

<form method="POST">
<button name="answer" value="12">12</button>
<button name="answer" value="10">10</button>
</form>

<p>You: <?php echo $_SESSION['user_score']; ?></p>
<p>Computer: <?php echo $_SESSION['bot_score']; ?></p>

</div>

</body>
</html>