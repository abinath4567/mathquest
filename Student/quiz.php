<?php
include 'db.php';
session_start();

// LOGIN CHECK
if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

// INIT
if (!isset($_SESSION['level'])) $_SESSION['level'] = 1;
if (!isset($_SESSION['score'])) $_SESSION['score'] = 0;
if (!isset($_SESSION['q_index'])) $_SESSION['q_index'] = 0;

$level = $_SESSION['level'];
$index = $_SESSION['q_index'];

// LOAD QUESTIONS
if (!isset($_SESSION['questions'])) {
    $res = $conn->query("SELECT * FROM questions WHERE level=$level ORDER BY RAND() LIMIT 5");

    $_SESSION['questions'] = [];
    while ($row = $res->fetch_assoc()) {
        $_SESSION['questions'][] = $row;
    }
}

$questions = $_SESSION['questions'];
$total = count($questions);

// HANDLE ANSWER
if (isset($_POST['answer'])) {

    if (isset($questions[$index])) {
        if ($_POST['answer'] == $questions[$index]['correct']) {
            $_SESSION['score'] += 10;
        }
    }

    $_SESSION['q_index']++;
    header("Location: Quiz.php");
    exit();
}

// CHECK END
if ($index >= $total) {

    $_SESSION['level']++;
    $_SESSION['q_index'] = 0;
    unset($_SESSION['questions']);

    if ($_SESSION['level'] > 3) {

        // COMPLETE CHALLENGE
        if (!isset($_SESSION['completed_challenges'])) {
            $_SESSION['completed_challenges'] = [];
        }

        if (!in_array(1, $_SESSION['completed_challenges'])) {
            $_SESSION['completed_challenges'][] = 1;

            $_SESSION['xp_gain'] = 50;

            $uid = $_SESSION['user_id'];
            $conn->query("UPDATE users SET points = points + 50 WHERE user_id = $uid");
        }

        header("Location: Result.php");
        exit();
    }

    header("Location: Quiz.php");
    exit();
}

$q = $questions[$index];
$progress = (($index + 1) / $total) * 100;
?>

<!DOCTYPE html>
<html>
<head>
<title>MathQuest Game</title>

<style>
body {
    margin:0;
    font-family:'Poppins',sans-serif;
    background: linear-gradient(135deg,#1f1c2c,#928dab);
    color:white;
    overflow:hidden;
}

/* FLOATING ICONS */
.bg {
    position:absolute;
    font-size:40px;
    opacity:0.1;
    animation: float 10s linear infinite;
}
@keyframes float {
    from {transform: translateY(100vh);}
    to {transform: translateY(-10vh);}
}

/* TOP BAR */
.top {
    display:flex;
    justify-content:space-between;
    padding:20px;
    font-weight:bold;
    font-size:1.1em;
}

/* TIMER */
.timer {
    background:red;
    padding:5px 12px;
    border-radius:10px;
}

/* PROGRESS */
.progress-bar {
    height:8px;
    background:#333;
}
.progress-fill {
    height:100%;
    background:linear-gradient(to right,#00f260,#0575e6);
    width:<?php echo $progress; ?>%;
    transition:0.4s;
}

/* CARD */
.card {
    background:white;
    color:black;
    width:650px;
    margin:40px auto;
    padding:30px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 15px 40px rgba(0,0,0,0.5);
    animation: fadeIn 0.5s;
}

@keyframes fadeIn {
    from {opacity:0; transform:translateY(20px);}
    to {opacity:1;}
}

/* QUESTION */
.question {
    font-size:1.8em;
    margin-bottom:25px;
}

/* BUTTON */
.btn {
    padding:15px;
    margin:10px;
    width:85%;
    border:none;
    border-radius:15px;
    font-size:1.2em;
    cursor:pointer;
    color:white;
    transition:0.2s;
}

.btn:hover {
    transform:scale(1.08);
}

/* COLORS */
.red{background:#ff4d4d;}
.blue{background:#339af0;}
.yellow{background:#ffd43b;color:black;}

/* POPUP */
.popup {
    position:fixed;
    top:40%;
    left:50%;
    transform:translate(-50%,-50%) scale(0);
    background:white;
    color:black;
    padding:30px;
    border-radius:20px;
    font-size:1.5em;
    transition:0.3s;
}
</style>
</head>

<body>

<!-- FLOATING -->
<div class="bg" style="left:10%">➕</div>
<div class="bg" style="left:50%">➖</div>
<div class="bg" style="left:80%">✖</div>

<div class="progress-bar">
<div class="progress-fill"></div>
</div>

<div class="top">
<div>Level <?php echo $level; ?></div>
<div>Score: <?php echo $_SESSION['score']; ?></div>
<div class="timer">⏱ <span id="time">10</span></div>
</div>

<div class="card">

<div class="question">
<?php echo htmlspecialchars($q['question']); ?>
</div>

<form method="POST" id="quizForm">

<button type="button" class="btn red"
onclick="check(1,<?php echo $q['correct'];?>)">
<?php echo htmlspecialchars($q['option1']); ?>
</button>

<button type="button" class="btn blue"
onclick="check(2,<?php echo $q['correct'];?>)">
<?php echo htmlspecialchars($q['option2']); ?>
</button>

<button type="button" class="btn yellow"
onclick="check(3,<?php echo $q['correct'];?>)">
<?php echo htmlspecialchars($q['option3']); ?>
</button>

<input type="hidden" name="answer" id="ans">

</form>

</div>

<div class="popup" id="popup"></div>

<script>
// SOUND
let correctSound = new Audio("https://www.soundjay.com/buttons/sounds/button-3.mp3");
let wrongSound = new Audio("https://www.soundjay.com/buttons/sounds/button-10.mp3");

// CHECK
function check(sel, correct){
    clearInterval(timer);

    let p = document.getElementById("popup");

    if(sel == correct){
        p.innerHTML="🎉 Correct!";
        p.style.color="green";
        correctSound.play();
    } else {
        p.innerHTML="❌ Wrong!";
        p.style.color="red";
        wrongSound.play();
    }

    p.style.transform="translate(-50%,-50%) scale(1)";
    document.getElementById("ans").value = sel;

    setTimeout(()=>{
        document.getElementById("quizForm").submit();
    },1000);
}

// TIMER
let time = 10;
let t = setInterval(()=>{
    time--;
    document.getElementById("time").innerText = time;

    if(time <= 0){
        clearInterval(t);
        document.getElementById("quizForm").submit();
    }
},1000);
</script>

</body>
</html>