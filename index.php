<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MathQuest - Welcome</title>

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* MAIN CONTAINER */
.container {
    text-align: center;
    background: white;
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    max-width: 700px;
    width: 100%;
}

/* TITLE */
h1 {
    margin-bottom: 10px;
    font-size: 36px;
    color: #333;
}

/* SUBTEXT */
p {
    color: #777;
    margin-bottom: 30px;
}

/* CARD WRAPPER */
.role-cards {
    display: flex;
    gap: 25px;
    justify-content: center;
    flex-wrap: wrap;
}

/* CARD */
.card {
    background: linear-gradient(135deg, #fdfbfb, #ebedee);
    border-radius: 15px;
    padding: 25px;
    width: 150px;
    text-decoration: none;
    color: #333;
    transition: 0.3s;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

/* HOVER EFFECT */
.card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

/* ICON */
.icon {
    font-size: 40px;
    margin-bottom: 10px;
}

/* TITLE */
.card h3 {
    margin: 10px 0 0;
    font-size: 18px;
}

/* DIFFERENT COLORS */
.card:nth-child(1) {
    border-top: 5px solid #e74c3c;
}

.card:nth-child(2) {
    border-top: 5px solid #27ae60;
}

.card:nth-child(3) {
    border-top: 5px solid #f39c12;
}
</style>

</head>
<body>

<div class="container">

    <h1>🎮 MathQuest</h1>
    <p>Select your portal to begin your journey</p>

    <div class="role-cards">

        <a href="Admin/" class="card">
            <div class="icon">🛡️</div>
            <h3>Admin</h3>
        </a>

        <a href="Student/" class="card">
            <div class="icon">🎓</div>
            <h3>Student</h3>
        </a>

        <a href="Teacher/" class="card">
            <div class="icon">🏫</div>
            <h3>Teacher</h3>
        </a>

    </div>

</div>

</body>
</html>