<?php
include 'db.php';

$message = "";

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();

        $message = "Account created successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Signup - MathQuest</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
body {
    background: #e8f5e9;
    font-family: 'Poppins', sans-serif;
    margin: 0;
}

.container {
    width: 350px;
    margin: 80px auto;
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

.message {
    margin-bottom: 10px;
    color: green;
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

    <h2>Signup</h2>

    <?php if ($message != "") { ?>
        <div class="message"><?php echo $message; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button name="signup">Create Account</button>
    </form>

    <p>Already have an account?</p>
    <a href="SignIn.php">Login here</a>

</div>

</body>
</html>