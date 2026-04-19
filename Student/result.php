<?php
include 'db.php';
session_start();

$score = $_SESSION['score'] ?? 0;
$user_id = $_SESSION['user_id'];

/* ADD POINTS */
$stmt = $conn->prepare("UPDATE users SET points = points + ? WHERE user_id=?");
$stmt->bind_param("ii",$score,$user_id);
$stmt->execute();

/* GET USER */
$res = $conn->query("SELECT username, points FROM users WHERE user_id=$user_id");
$user = $res->fetch_assoc();

$total_points = $user['points'];

/* LEVEL SYSTEM */
$level = floor($total_points / 100) + 1;
$current_xp = $total_points % 100;
$xp_needed = 100;

/* MESSAGE */
if($score >= 80) $msg = "🔥 Amazing!";
elseif($score >= 50) $msg = "👍 Good Job!";
else $msg = "😅 Try Again!";
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family:'Poppins', sans-serif;
    background: radial-gradient(circle,#1f1c2c,#928dab);
    margin:0;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
    overflow:hidden;
}

/* CONFETTI */
canvas {
    position:fixed;
    top:0;
    left:0;
    pointer-events:none;
}

/* CARD */
.card {
    background:white;
    color:black;
    width:450px;
    padding:50px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,0.6);
    animation: pop 0.6s ease;
}

@keyframes pop {
    from {transform:scale(0.7); opacity:0;}
    to {transform:scale(1); opacity:1;}
}

/* SCORE */
.score {
    font-size:70px;
    color:#4CAF50;
    font-weight:bold;
    animation: bounce 0.6s;
}

@keyframes bounce {
    0%{transform:scale(0.5);}
    100%{transform:scale(1);}
}

/* MESSAGE */
.msg {
    font-size:20px;
    margin:10px 0;
}

/* LEVEL */
.level {
    font-size:22px;
    font-weight:bold;
    margin-top:10px;
}

/* XP BAR */
.xp-bar {
    width:100%;
    background:#ddd;
    border-radius:20px;
    overflow:hidden;
    margin:15px 0;
}

.xp-fill {
    height:20px;
    background:linear-gradient(135deg,#00f260,#0575e6);
    width:0%;
}

/* BUTTON */
.btn {
    display:inline-block;
    padding:12px 25px;
    margin:10px;
    background:linear-gradient(135deg,#4CAF50,#2ecc71);
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover {
    transform:scale(1.05);
}

.btn2 {
    background:#333;
}
</style>
</head>

<body>

<canvas id="confetti"></canvas>

<div class="card">

<h2>🎮 Game Result</h2>

<div class="score"><?php echo $score; ?></div>

<div class="msg"><?php echo $msg; ?></div>

<div class="level">🏆 Level <?php echo $level; ?></div>

<!-- XP BAR -->
<div class="xp-bar">
    <div class="xp-fill" id="xpFill"></div>
</div>

<div><?php echo $current_xp; ?> / <?php echo $xp_needed; ?> XP</div>

<a href="Quiz.php" class="btn">Play Again</a>
<a href="Dashboard.php" class="btn btn2">Dashboard</a>

</div>

<script>
// XP ANIMATION
let xp = <?php echo ($current_xp / $xp_needed)*100; ?>;
setTimeout(()=>{
    document.getElementById("xpFill").style.width = xp + "%";
},300);

// CONFETTI
let canvas = document.getElementById("confetti");
let ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let pieces = [];
for(let i=0;i<120;i++){
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
</script>

</body>
</html>

<?php
unset($_SESSION['score'],$_SESSION['q_index'],$_SESSION['level'],$_SESSION['questions']);
?>