<?php
session_start();
include 'db.php';

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <title>MathQuest Login</title>

<style>
    body {
        font-family: Arial;
        background: linear-gradient(to right, rgb(52,152,219), rgb(155,89,182));
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-box {
        background: white;
        width: 320px;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
    }

    input {
        width: 90%;
        padding: 10px;
        margin: 10px 0;
    }

    button {
        background-color: rgb(52,152,219);
        color: white;
        padding: 10px;
        width: 95%;
        border: none;
        cursor: pointer;
    }

    .msg {
        margin-top: 10px;
        color: red;
    }
</style>


</head>

<body>

<div class="login-box">
    <h2>MathQuest Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <?php if($error != ""): ?>
        <div class="msg"><?php echo $error; ?></div>
    <?php endif; ?>

</div>

</body>
</html>

