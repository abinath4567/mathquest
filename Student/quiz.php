<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

// DEFAULT LEVEL
if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = 1;
}

// Initialize score + index
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['q_index'] = 0;
}

// Get level
$level = $_SESSION['level'];

// RANDOM QUESTIONS BY LEVEL
$result = $conn->query("SELECT * FROM questions WHERE level=$level ORDER BY RAND() LIMIT 5");

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

$index = $_SESSION['q_index'];

// Answer check
if (isset($_POST['answer'])) {
    if ($_POST['answer'] == $questions[$index]['correct']) {
        $_SESSION['score'] += 10;
    }
    $_SESSION['q_index']++;
    header("Location: Quiz.php");
    exit();
}

// END LEVEL
if ($index >= count($questions)) {

    $_SESSION['level']++;

    if ($_SESSION['level'] > 3) {
        header("Location: Result.php");
    } else {
        $_SESSION['q_index'] = 0;
        header("Location: Quiz.php");
    }
    exit();
}

$q = $questions[$index];
?>

<!DOCTYPE html>
<html>
<head>
<title>Quiz</title>

<style>
body {
    font-family: Poppins;
    background: #e8f5e9;
    text-align: center;
}

.card {
    background: white;
    width: 400px;
    margin: 80px auto;
    padding: 30px;
    border-radius: 15px;
}

button {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: none;
    background: #4CAF50;
    color: white;
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

<h3>Level <?php echo $level; ?></h3>

<h2><?php echo $q['question']; ?></h2>

<form method="POST">
<button name="answer" value="1"><?php echo $q['option1']; ?></button>
<button name="answer" value="2"><?php echo $q['option2']; ?></button>
<button name="answer" value="3"><?php echo $q['option3']; ?></button>
</form>

<p>Score: <?php echo $_SESSION['score']; ?></p>

</div>

</body>
</html>