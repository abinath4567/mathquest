<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

// Initialize session
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['q_index'] = 0;
}

// Get questions
$result = $conn->query("SELECT * FROM questions");
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

// End quiz
if ($index >= count($questions)) {
    header("Location: Result.php");
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