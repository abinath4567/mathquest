<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MathQuest - Student Portal</title>

<style>
body {
    margin: 0;
    font-family: 'Comic Sans MS', cursive;
    height: 100vh;
    background: linear-gradient(135deg, #43cea2, #185a9d);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* FLOATING NUMBERS */
.number {
    position: absolute;
    font-size: 50px;
    color: white;
    opacity: 0.15;
    animation: float 12s infinite linear;
}

@keyframes float {
    0% { transform: translateY(100vh); }
    100% { transform: translateY(-10vh); }
}

/* MAIN CARD */
.container {
    text-align: center;
    background: rgba(255,255,255,0.95);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    max-width: 450px;
    width: 100%;
    animation: fadeIn 1s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform:translateY(20px);}
    to {opacity:1; transform:translateY(0);}
}

h1 {
    font-size: 2.5em;
    color: #2c3e50;
    margin-bottom: 10px;
}

p {
    color: #555;
    margin-bottom: 30px;
}

/* BUTTONS */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.btn {
    padding: 15px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1em;
    transition: 0.3s;
}

/* LOGIN */
.btn-login {
    background: #ff6b6b;
    color: white;
}

.btn-login:hover {
    background: #e63946;
    transform: scale(1.05);
}

/* REGISTER */
.btn-register {
    background: #4dabf7;
    color: white;
}

.btn-register:hover {
    background: #1c7ed6;
    transform: scale(1.05);
}
</style>
</head>

<body>

<!-- FLOATING NUMBERS -->
<div class="number" style="left:10%;">1</div>
<div class="number" style="left:30%;">2</div>
<div class="number" style="left:50%;">3</div>
<div class="number" style="left:70%;">4</div>
<div class="number" style="left:85%;">5</div>

<div class="container">
    <h1>🎮 MathQuest</h1>
    <p>Fun & Interactive Math Learning for Kids 🚀</p>

    <div class="action-buttons">
        <a href="SignIn.php" class="btn btn-login">
            🎯 Start Playing
        </a>

        <a href="Signup.php" class="btn btn-register">
            📝 Create Account
        </a>
    </div>
</div>

</body>
</html>