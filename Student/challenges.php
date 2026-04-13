<?php
session_start();
include 'db.php';

// default user (safe fallback)
$user_id = $_SESSION['user_id'] ?? 1;

/* HANDLE COMPLETE */
if (isset($_POST['complete'])) {

    if (!isset($_POST['cid']) || empty($_POST['cid'])) {
        exit;
    }

    $cid = (int)$_POST['cid'];

    // get reward
    $res = $conn->query("SELECT reward_points FROM challenges WHERE challenge_id=$cid");

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $points = $row['reward_points'];

        // add points to user
        $conn->query("
            UPDATE users 
            SET points = points + $points 
            WHERE user_id = $user_id
        ");

        $_SESSION['last_done'] = $cid;
    }

    header("Location: challenges.php");
    exit();
}

/* GET CHALLENGES (ONLY ACTIVE ONES) */
$result = $conn->query("SELECT * FROM challenges WHERE status = 'active'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Challenges</title>

<style>
body {
    font-family: Poppins;
    background: linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    text-align:center;
}

.container {
    background:white;
    color:black;
    width:450px;
    margin:70px auto;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.challenge {
    background:#f5f5f5;
    padding:15px;
    margin:15px 0;
    border-radius:12px;
    text-align:left;
}

.challenge h3 {
    margin:0;
}

.challenge p {
    margin:5px 0;
    color:#555;
}

button {
    margin-top:10px;
    background:#4CAF50;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:8px;
    cursor:pointer;
}

button:hover {
    background:#2e7d32;
}

.done {
    background:#ccc !important;
    cursor:not-allowed;
}
</style>
</head>

<body>

<div class="container">
<h2>🎯 Challenges</h2>

<?php
if ($result && $result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        $cid = $row['challenge_id'];
        $title = $row['title'];
        $desc = $row['description'];
        $points = $row['reward_points'];

        $isDone = ($_SESSION['last_done'] ?? 0) == $cid;

        echo "
        <div class='challenge'>
            <h3>$title</h3>
            <p>$desc</p>
            <p><b>Reward:</b> $points XP</p>
        ";

        if ($isDone) {
            echo "<button class='done' disabled>✅ Completed</button>";
        } else {
            echo "
            <form method='POST'>
                <input type='hidden' name='cid' value='$cid'>
                <button name='complete'>Complete</button>
            </form>
            ";
        }

        echo "</div>";
    }

} else {
    echo "<p>No active challenges available</p>";
}
?>

<br>
<a href="dashboard.php">⬅ Back</a>

</div>

</body>
</html>