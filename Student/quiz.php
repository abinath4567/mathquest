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
    font-family:Poppins;
    background: radial-gradient(circle,#1a1a2e,#16213e);
    color:white;
}

/* TOP BAR */
.top {
    display:flex;
    justify-content:space-between;
    padding:20px;
    font-weight:bold;
}

/* TIMER */
#time {
    color:#ff5252;
}

/* PROGRESS */
.progress-bar {
    height:10px;
    background:#333;
}
.progress-fill {
    height:100%;
    background:#4CAF50;
    width:<?php echo $progress; ?>%;
}

/* CARD */
.card {
    background:white;
    color:black;
    width:650px;
    margin:50px auto;
    padding:30px;
    border-radius:25px;
    text-align:center;
}

/* BUTTON */
.btn {
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
.btn:hover { transform:scale(1.05); }

.red{background:#ff6b6b;}
.blue{background:#4dabf7;}
.yellow{background:#ffd43b;color:black;}

/* POPUP */
.popup {
    position:fixed;
    top:40%;
    left:50%;
    transform:translate(-50%,-50%);
    background:white;
    color:black;
    padding:30px;
    border-radius:20px;
    display:none;
}

/* CONFETTI */
#confetti {
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    pointer-events:none;
}
</style>
</head>

<body>

<!-- SOUNDS -->
<audio id="correctSound" src="https://pixabay.com/sound-effects/film-special-effects-wrong-answer-129254/"></audio>
<audio id="wrongSound" src="https://www.soundjay.com/buttons/sounds/button-10.mp3"></audio>
<audio id="timeoutSound" src="https://www.soundjay.com/buttons/sounds/button-2.mp3"></audio>

<canvas id="confetti"></canvas>

<div class="progress-bar">
<div class="progress-fill"></div>
</div>

<div class="top">
<div>Level <?php echo $level; ?></div>
<div>Score: <?php echo $_SESSION['score']; ?></div>
<div>⏱ <span id="time">10</span>s</div>
</div>

<div class="card">

<h2><?php echo htmlspecialchars($q['question']); ?></h2>

<form method="POST" id="quizForm">

<button type="button" class="btn red" onclick="check(1,<?php echo $q['correct'];?>)">
<?php echo $q['option1']; ?>
</button>

<button type="button" class="btn blue" onclick="check(2,<?php echo $q['correct'];?>)">
<?php echo $q['option2']; ?>
</button>

<button type="button" class="btn yellow" onclick="check(3,<?php echo $q['correct'];?>)">
<?php echo $q['option3']; ?>
</button>

<input type="hidden" name="answer" id="ans">

</form>

</div>

<div class="popup" id="popup"></div>

<script>
// TIMER
let time = 10;
let timer = setInterval(()=>{
    time--;
    document.getElementById("time").innerText = time;

    if(time <= 0){
        clearInterval(timer);
        document.getElementById("timeoutSound").play();

        let p = document.getElementById("popup");
        p.innerHTML = "⏰ Time's Up!";
        p.style.display = "block";

        setTimeout(()=>{
            document.getElementById("quizForm").submit();
        },1000);
    }
},1000);


// CHECK ANSWER
function check(sel, correct){
    clearInterval(timer);

    let p = document.getElementById("popup");

    if(sel == correct){
        p.innerHTML="🎉 Correct!";
        p.style.color="green";
        document.getElementById("correctSound").play();
        confetti();
    } else {
        p.innerHTML="❌ Wrong!";
        p.style.color="red";
        document.getElementById("wrongSound").play();
    }

    p.style.display="block";

    document.getElementById("ans").value = sel;

    setTimeout(()=>{
        document.getElementById("quizForm").submit();
    },1000);
}


// CONFETTI
function confetti(){
    let canvas = document.getElementById("confetti");
    let ctx = canvas.getContext("2d");

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let pieces = [];

    for(let i=0;i<100;i++){
        pieces.push({
            x: Math.random()*canvas.width,
            y: Math.random()*canvas.height,
            size: Math.random()*5+2,
            speed: Math.random()*3+2
        });
    }

    function draw(){
        ctx.clearRect(0,0,canvas.width,canvas.height);

        pieces.forEach(p=>{
            ctx.fillStyle = "hsl("+Math.random()*360+",100%,50%)";
            ctx.fillRect(p.x,p.y,p.size,p.size);
            p.y += p.speed;

            if(p.y > canvas.height){
                p.y = 0;
            }
        });

        requestAnimationFrame(draw);
    }

    draw();

    setTimeout(()=>{
        ctx.clearRect(0,0,canvas.width,canvas.height);
    },1000);
}
</script>

</body>
</html>