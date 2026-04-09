<?php
session_start();
include 'db.php';

$error = "";

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check user
    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Plain password check (same as your signup)
        if ($password === $user['password']) {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            header("Location: Dashboard.php");
            exit();

        } else {
            $error = "Wrong password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - MathQuest</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #4CAF50;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: white;
    padding: 40px;
    border-radius: 12px;
    width: 350px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

h2 {
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

input:focus {
    border-color: #4CAF50;
    outline: none;
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
}
</style>

</head>
<body>

<div class="container">

    <h2>Login</h2>

    <?php if ($error != "") { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account?</p>
    <a href="Signup.php">Register here</a>

</div>

</body>
</html>