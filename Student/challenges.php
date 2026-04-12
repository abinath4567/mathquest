<!DOCTYPE html>
<html>
<head>
<title>Challenges</title>

<style>
body {
    margin:0;
    font-family:'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    min-height:100vh;
}

/* MAIN CONTAINER */
.container {
    max-width: 900px;
    margin: 50px auto;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    text-align: center;
}

/* TITLE */
h1 {
    margin-bottom: 10px;
    color: #333;
}

/* USER INFO */
.user {
    font-weight: bold;
    margin-bottom: 25px;
    color: #555;
}

/* GRID */
.challenge-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* CARD */
.challenge {
    background: linear-gradient(135deg, #f6f9ff, #eef1ff);
    padding: 20px;
    border-radius: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: 0.3s;
    border: 2px solid transparent;
}

.challenge:hover {
    transform: translateY(-5px);
    border-color: #667eea;
}

/* TEXT */
.challenge strong {
    font-size: 18px;
    color: #333;
}

.challenge p {
    margin: 5px 0;
    color: #666;
    font-size: 14px;
}

/* BUTTON */
.btn {
    padding: 10px 18px;
    background: linear-gradient(135deg, #4CAF50, #2ecc71);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.btn:hover {
    transform: scale(1.05);
}

/* COMPLETED */
.done {
    background: gray;
    pointer-events: none;
}

/* BACK BUTTON */
.back {
    margin-top: 30px;
    display: inline-block;
    padding: 12px 25px;
    background: #333;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    transition: 0.3s;
}

.back:hover {
    background: black;
}
</style>
</head>

<body>

<div class="container">

<h1>🎯 Challenges</h1>

<div class="user">
Hello <?php echo htmlspecialchars($user['username']); ?> |
Points: <?php echo $user['points']; ?>
</div>

<div class="challenge-list">

<?php while ($c = $challenges->fetch_assoc()) { 

    $cid = $c['challenge_id'];

    $doneCheck = $conn->query("SELECT * FROM user_challenges WHERE user_id=$user_id AND challenge_id=$cid");
    $done = ($doneCheck && $doneCheck->num_rows > 0);
?>

<div class="challenge">
    <div>
        <strong><?php echo htmlspecialchars($c['title']); ?></strong>
        <p><?php echo htmlspecialchars($c['description']); ?></p>
        <p><b>Reward:</b> <?php echo $c['reward_points']; ?> pts</p>
    </div>

    <?php if ($done) { ?>
        <span class="btn done">Completed</span>
    <?php } else { ?>
        <a href="challenges.php?complete=<?php echo $cid; ?>" class="btn">Complete</a>
    <?php } ?>
</div>

<?php } ?>

</div>

<a href="Dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>