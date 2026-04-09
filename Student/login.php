<?php
include 'db.php';
session_start();

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: Dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - MathQuest</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
body {
    background: #e8f5e9;
    font-family: 'Poppins', sans-serif;
    margin: 0;
}

.container {
    width: 350px;
    margin: 100px auto;
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
}

input:focus {
    border-color: #4CAF50;
}

button {
    width: 100%;
    padding: 12px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #388E3C;
}

.error {
    color: red;
    margin-bottom: 10px;
}

a {
    text-decoration: none;
    color: #4CAF50;
    font-size: 0.9em;
}
</style>

</head>

<body>

<div class="container">

    <h2>Login</h2>

    <?php if ($error != "") { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button name="login">Login</button>
    </form>

    <p>Don't have an account?</p>
    <a href="Signup.php">Register here</a>

</div>

</body>
</html>