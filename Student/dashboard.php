<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username, points FROM users WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

/* HEADER */
.header {
    text-align: center;
    color: white;
    padding: 40px 20px;
}

.header h1 {
    margin: 0;
    font-size: 2.5em;
}

.header p {
    margin-top: 10px;
    font-size: 1.1em;
}

/* POINTS BADGE */
.points {
    display: inline-block;
    margin-top: 15px;
    background: rgba(255,255,255,0.2);
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: bold;
}

/* MENU GRID */
.menu {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
}

/* CARDS */
.card {
    padding: 30px;
    border-radius: 20px;
    color: white;
    text-decoration: none;
    text-align: center;
    font-weight: bold;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-8px) scale(1.03);
}

/* CARD COLORS */
.quiz { background: linear-gradient(135deg, #ff6a00, #ee0979); }
.challenge { background: linear-gradient(135deg, #00c6ff, #0072ff); }
.leaderboard { background: linear-gradient(135deg, #f7971e, #ffd200); color:black; }
.result { background: linear-gradient(135deg, #11998e, #38ef7d); }

/* FOOTER */
.footer {
    text-align: center;
    margin: 30px;
}

.logout {
    color: white;
    text-decoration: none;
    font-weight: bold;
    background: rgba(0,0,0,0.3);
    padding: 10px 20px;
    border-radius: 10px;
}

.logout:hover {
    background: rgba(0,0,0,0.5);
}
</style>

</head>

<body>

<div class="header">
    <h1>Welcome, <?php echo $data['username']; ?></h1>
    <p>Ready to challenge your math skills?</p>

    <div class="points">
        Total Points: <?php echo $data['points']; ?>
    </div>
</div>

<div class="menu">

    <a href="Quiz.php" class="card quiz">
        Start Quiz
    </a>

    <a href="Challenge.php" class="card challenge">
        1 vs 1 Challenge
    </a>

    <a href="Leaderboard.php" class="card leaderboard">
        Leaderboard
    </a>

    <a href="Result.php" class="card result">
        My Results
    </a>

</div>

<div class="footer">
    <a href="SignIn.php" class="logout">Logout</a>
</div>

</body>
</html>