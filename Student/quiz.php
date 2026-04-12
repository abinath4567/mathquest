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

// HANDLE ANSWER (NO PROCESS.PHP)
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
if ($index >= count($questions)) {

    $_SESSION['level']++;
    $_SESSION['q_index'] = 0;
    unset($_SESSION['questions']);

    if ($_SESSION['level'] > 3) {
        header("Location: Result.php");
        exit();
    }

    header("Location: Quiz.php");
    exit();
}

// SAFE QUESTION
$q = $questions[$index];
?>

<!DOCTYPE html>
<html>
<head>
<title>Fun Math Quiz</title>

<style>
body {
    margin:0;
    font-family:'Comic Sans MS';
    background:linear-gradient(135deg,#ff9a9e,#fad0c4);
    overflow:hidden;
}

/* FLOATING NUMBERS */
.number{
    position:absolute;
    font-size:50px;
    opacity:0.2;
    animation:float 12s infinite linear;
}
@keyframes float{
    0%{transform:translateY(100vh);}
    100%{transform:translateY(-10vh);}
}

/* TOP BAR */
.top{
    display:flex;
    justify-content:space-between;
    padding:20px;
    font-weight:bold;
    font-size:1.2em;
}

/* CARD */
.card{
    background:white;
    width:600px;
    margin:40px auto;
    padding:30px;
    border-radius:25px;
    text-align:center;
}

/* QUESTION */
.question{
    font-size:2em;
    margin-bottom:20px;
}

/* BUTTONS */
.btn{
    padding:15px;
    margin:10px;
    width:80%;
    border:none;
    border-radius:15px;
    font-size:1.2em;
    cursor:pointer;
    color:white;
    transition:0.2s;
}
.btn:hover{transform:scale(1.05);}

.red{background:#ff6b6b;}
.blue{background:#4dabf7;}
.yellow{background:#ffd43b;color:black;}

/* POPUP */
.popup{
    position:fixed;
    top:40%;
    left:50%;
    transform:translate(-50%,-50%);
    background:white;
    padding:30px;
    border-radius:20px;
    display:none;
    font-size:1.5em;
}

/* TIMER */
.timer{color:red;}
</style>

</head>

<body>

<!-- FLOATING NUMBERS -->
<div class="number" style="left:10%;">1</div>
<div class="number" style="left:40%;">2</div>
<div class="number" style="left:70%;">3</div>

<div class="top">
<div>Level <?php echo $level; ?></div>
<div>Score: <?php echo $_SESSION['score']; ?></div>
<div class="timer">Time: <span id="time">10</span></div>
</div>

<div class="card">

<div class="question">
<?php echo htmlspecialchars($q['question']); ?>
</div>

<form method="POST" id="quizForm">

<button type="button" class="btn red"
onclick="checkAnswer(1,<?php echo $q['correct'];?>)">
<?php echo htmlspecialchars($q['option1']); ?>
</button>

<button type="button" class="btn blue"
onclick="checkAnswer(2,<?php echo $q['correct'];?>)">
<?php echo htmlspecialchars($q['option2']); ?>
</button>

<button type="button" class="btn yellow"
onclick="checkAnswer(3,<?php echo $q['correct'];?>)">
<?php echo htmlspecialchars($q['option3']); ?>
</button>

<input type="hidden" name="answer" id="ans">

</form>

</div>

<div class="popup" id="popup"></div>

<script>
// CHECK ANSWER
function checkAnswer(selected, correct){

    let popup = document.getElementById("popup");

    if(selected == correct){
        popup.innerHTML="🎉 Correct!";
        popup.style.color="green";
    }else{
        popup.innerHTML=" Wrong!";
        popup.style.color="red";
    }

    popup.style.display="block";

    document.getElementById("ans").value = selected;

    setTimeout(()=>{
        document.getElementById("quizForm").submit();
    },1000);
}

// TIMER
let time=10;
let t=setInterval(()=>{
    time--;
    document.getElementById("time").innerText=time;

    if(time<=0){
        clearInterval(t);
        document.getElementById("quizForm").submit();
    }
},1000);
</script>

</body>
</html>