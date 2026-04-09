<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: SignIn.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, points FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $points = $row['points'];
} else {
    $username = "User";
    $points = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MathQuest Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body {
    background-color: #e8f5e9;
    font-family: 'Poppins', sans-serif;
    margin: 0;
}

nav {
    background: white;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

nav a {
    text-decoration: none;
    color: #555;
    margin: 0 15px;
    font-weight: 600;
}

nav a:hover {
    color: #4CAF50;
}

.dashboard-hero {
    background: linear-gradient(135deg, #4CAF50, #2E7D32);
    color: white;
    padding: 50px 20px;
    text-align: center;
    border-radius: 0 0 30px 30px;
}

.welcome-text {
    font-size: 2.5em;
    font-weight: 700;
}

.points-display {
    background: rgba(255,255,255,0.2);
    padding: 10px 25px;
    border-radius: 50px;
    margin-top: 20px;
}

.points-count {
    font-weight: bold;
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 20px;
}

.menu-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    text-decoration: none;
    color: #333;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.menu-card:hover {
    transform: translateY(-10px);
}

h3 { margin: 0; }
p { color:#777; font-size: 0.9em; }
</style>

</head>

<body>

<nav>
    <a href="Dashboard.php" style="color:#4CAF50;">Home</a>
    <a href="Quiz.php">Quiz</a>
    <a href="Challenge.php">1 vs 1</a>
    <a href="Leaderboard.php">Leaderboard</a>
    <a href="logout.php" style="color:#e74c3c;">Logout</a>
</nav>

<div class="dashboard-hero">
    <h1 class="welcome-text">
        Hello, <?php echo htmlspecialchars($username); ?>
    </h1>

    <div class="points-display">
        Total Points: <span class="points-count"><?php echo $points; ?></span>
    </div>
</div>

<div class="menu-grid">

    <a href="Quiz.php" class="menu-card">
        <h3>Play Quiz</h3>
        <p>Practice math questions</p>
    </a>

    <a href="Challenge.php" class="menu-card">
        <h3>1 vs 1 Challenge</h3>
        <p>Compete with computer</p>
    </a>

    <a href="Leaderboard.php" class="menu-card">
        <h3>Leaderboard</h3>
        <p>See top players</p>
    </a>

    <a href="logout.php" class="menu-card">
        <h3>Logout</h3>
        <p>Exit your account</p>
    </a>

</div>

</body>
</html>