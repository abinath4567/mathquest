<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mathquest");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$error = false;

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($password)) {
        $message = "Username and password required!";
        $error = true;
    } else {
        // Query user from database using prepared statement
        $sql = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful - create session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // Redirect based on role
                if ($user['role'] == 'teacher') {
                    header("Location: dashboard.php");
                } else {
                    header("Location: student_dashboard.html");
                }
                exit();
            } else {
                $message = "Invalid password!";
                $error = true;
            }
        } else {
            $message = "Username not found!";
            $error = true;
        }
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

        h2 {
            margin-bottom: 20px;
            color: rgb(52,152,219);
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: rgb(52,152,219);
            color: white;
            padding: 10px;
            width: 95%;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        button:hover {
            background-color: rgb(155,89,182);
        }

        .msg {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            color: red;
            background: #fee;
        }

        .success {
            color: green;
            background: #efe;
        }

        .signup-link {
            margin-top: 15px;
        }

        .signup-link a {
            color: rgb(52,152,219);
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
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

        <?php if($message != ""): ?>
            <div class="msg <?php echo !$error ? 'success' : ''; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>

