<?php
$conn = new mysqli("localhost", "root", "", "mathquest");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_POST['signup'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = isset($_POST['role']) ? $_POST['role'] : 'student';

    // Validate input
    if (empty($username) || empty($password)) {
        $message = "Username and password required!";
    } else if (strlen($password) < 6) {
        $message = "Password must be at least 6 characters!";
    } else {
        // Check if username already exists using prepared statement
        $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "Username already exists!";
        } else {
            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $username, $hashed_password, $role);

            if ($sql->execute()) {
                $message = "Sign up successful! You can login now.";
            } else {
                $message = "Error: " . $conn->error;
            }
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
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>

        <button type="submit" name="signup">Sign Up</button>
    </form>

    <!-- Message -->
    <?php if($message != ""): ?>
        <div class="msg <?php echo ($message == 'Sign up successful! You can login now.') ? 'success' : ''; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <a href="login.php">Already have an account? Login</a>
</div>

</body>
</html>