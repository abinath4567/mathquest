<?php
$conn = new mysqli("localhost", "root", "", "mathquest");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_POST['signup'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // Check if username already exists
    $check = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        $message = "Username already exists!";
    } else {

        // Insert user
        $sql = "INSERT INTO users (username, password, role)
                VALUES ('$username', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $message = "Signup successful! You can login now.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - MathQuest</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right, rgb(52,152,219), rgb(155,89,182));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input, select {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            background: rgb(155,89,182);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background: rgb(52,152,219);
        }

        .msg {
            margin-top: 10px;
            color: red;
        }

        .success {
            color: green;
        }

        a {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: rgb(52,152,219);
        }
    </style>
</head>

<body>

<div class="box">
    <h2>Create Account</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="Student">Student</option>
            <option value="Teacher">Teacher</option>
            
        </select>

        <button type="submit" name="signup">Sign Up</button>
    </form>

    <!-- Message -->
    <?php if($message != ""): ?>
        <div class="msg <?php echo ($message == 'Signup successful! You can login now.') ? 'success' : ''; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <a href="login.php">Already have an account? Login</a>
</div>

</body>
</html>