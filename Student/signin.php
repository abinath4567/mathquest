<?php
include 'db.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: Dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MathQuest Login</title>

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* FLOATING MATH SYMBOLS */
.symbol {
    position: absolute;
    font-size: 50px;
    color: white;
    opacity: 0.1;
    animation: float 12s linear infinite;
}

@keyframes float {
    0% { transform: translateY(100vh); }
    100% { transform: translateY(-10vh); }
}

/* LOGIN CARD */
.login-box {
    background: white;
    padding: 40px;
    border-radius: 20px;
    width: 350px;
    text-align: center;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    animation: fadeIn 0.8s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform:translateY(20px);}
    to {opacity:1; transform:translateY(0);}
}

h2 {
    margin-bottom: 10px;
    color: #333;
}

p {
    color: #777;
    margin-bottom: 25px;
}

/* INPUT */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 10px;
    border: 1px solid #ddd;
    outline: none;
    transition: 0.3s;
}

input:focus {
    border-color: #667eea;
}

/* BUTTON */
button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    border: none;
    border-radius: 10px;
    background: #667eea;
    color: white;
    font-size: 1em;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #5a67d8;
    transform: scale(1.05);
}

/* ERROR */
.error {
    color: red;
    margin-top: 10px;
}

/* LINK */
.link {
    margin-top: 15px;
    display: block;
    color: #555;
    text-decoration: none;
}

.link:hover {
    text-decoration: underline;
}
</style>
</head>

<body>

<!-- FLOATING SYMBOLS -->
<div class="symbol" style="left:10%;">+</div>
<div class="symbol" style="left:30%;">−</div>
<div class="symbol" style="left:50%;">×</div>
<div class="symbol" style="left:70%;">÷</div>
<div class="symbol" style="left:85%;">=</div>

<div class="login-box">
    <h2>🎮 MathQuest Login</h2>
    <p>Enter your details to start playing</p>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">🚀 Login</button>
    </form>

    <?php if ($error != "") { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <a href="Signup.php" class="link">Don't have an account? Register</a>
</div>

</body>
</html>