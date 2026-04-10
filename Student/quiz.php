<?php
include 'db.php';
session_start();

// LOGIN CHECK
if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

// INIT VALUES
if (!isset($_SESSION['level'])) $_SESSION['level'] = 1;
if (!isset($_SESSION['score'])) $_SESSION['score'] = 0;
if (!isset($_SESSION['q_index'])) $_SESSION['q_index'] = 0;

$level = $_SESSION['level'];
$score = $_SESSION['score'];
$index = $_SESSION['q_index'];

// LOAD QUESTIONS ONCE PER LEVEL
if (!isset($_SESSION['questions'])) {
    $res = $conn->query("SELECT * FROM questions WHERE level=$level ORDER BY RAND() LIMIT 5");

    $_SESSION['questions'] = [];

    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $_SESSION['questions'][] = $row;
        }
    }
}

// SAFETY CHECK
if (!isset($_SESSION['questions']) || count($_SESSION['questions']) == 0) {
    echo "No questions found. Please insert questions in database.";
    exit();
}

$questions = $_SESSION['questions'];

// HANDLE ANSWER
if (isset($_POST['answer']) && isset($questions[$index])) {

    if ($_POST['answer'] == $questions[$index]['correct']) {
        $_SESSION['score'] += 10;
    }

    $_SESSION['q_index']++;
    header("Location: Quiz.php");
    exit();
}

// LEVEL COMPLETE
if ($index >= count($questions)) {

    $_SESSION['level']++;
    unset($_SESSION['questions']);
    $_SESSION['q_index'] = 0;

    if ($_SESSION['level'] > 3) {
        header("Location: Result.php");
        exit();
    }

    header("Location: Quiz.php");
    exit();
}

// CURRENT QUESTION SAFE LOAD
$q = $questions[$index] ?? null;

if (!$q) {
    echo "Error loading question.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Quiz</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #1d2671, #c33764);
    color: white;
}

/* TOP BAR */
.top-bar {
    display: flex;
    justify-content: space-between;
    padding: 20px 40px;
    font-size: 1.1em;
}

/* CARD */
.card {
    background: white;
    color: #333;
    width: 550px;
    margin: 60px auto;
    padding: 40px;
    border-radius: 25px;
    text-align: center;
}

/* QUESTION */
.question {
    font-size: 1.8em;
    margin-bottom: 25px;
}

/* ANSWERS */
.answers {
    display: grid;
    gap: 15px;
}

/* BUTTONS */
.answer-btn {
    padding: 15px;
    border: none;
    border-radius: 12px;
    font-size: 1.1em;
    cursor: pointer;
    font-weight: bold;
    color: white;
}

/* COLORS */
.btn1 { background: #ff4b2b; }
.btn2 { background: #3498db; }
.btn3 { background: #f1c40f; color:black; }

.answer-btn:hover {
    transform: scale(1.05);
}
</style>

</head>

<body>

<div class="top-bar">
    <div>Level <?php echo $level; ?></div>
    <div>Score: <?php echo $_SESSION['score']; ?></div>
</div>

<div class="card">

    <div class="question">
        <?php echo htmlspecialchars($q['question']); ?>
    </div>

    <form method="POST" class="answers">
        <button class="answer-btn btn1" name="answer" value="1">
            <?php echo htmlspecialchars($q['option1']); ?>
        </button>

        <button class="answer-btn btn2" name="answer" value="2">
            <?php echo htmlspecialchars($q['option2']); ?>
        </button>

        <button class="answer-btn btn3" name="answer" value="3">
            <?php echo htmlspecialchars($q['option3']); ?>
        </button>
    </form>

</div>

</body>
</html>