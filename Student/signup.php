<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    
    if (mysqli_num_rows($check) > 0) {
        $message = "Username already exists!";
    } else {
        $sql = "INSERT INTO users (username, password, points) VALUES ('$username', '$password', 0)";
        
        if (mysqli_query($conn, $sql)) {
            $message = "Registration successful! You can login now.";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MathQuest Register</title>

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    height: 100vh;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* FLOATING SYMBOLS */
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

/* CARD */
.signup-box {
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
    border-color: #ff6b6b;
}

/* BUTTON */
button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    border: none;
    border-radius: 10px;
    background: #ff6b6b;
    color: white;
    font-size: 1em;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #e63946;
    transform: scale(1.05);
}

/* MESSAGE */
.message {
    margin-top: 10px;
    color: green;
}

/* ERROR */
.error {
    margin-top: 10px;
    color: red;
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

<div class="signup-box">
    <h2>📝 Create Account</h2>
    <p>Join MathQuest and start your adventure</p>

    <form method="POST">
        <input type="text" name="username" placeholder="Choose Username" required>
        <input type="password" name="password" placeholder="Choose Password" required>

        <button type="submit">🎯 Register</button>
    </form>

    <?php if ($message != "") { ?>
        <div class="message"><?php echo $message; ?></div>
    <?php } ?>

    <a href="SignIn.php" class="link">Already have an account? Login</a>
</div>

</body>
</html>