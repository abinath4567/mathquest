<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mathquest-1 - Welcome</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1da133;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .role-cards {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .card {
            background: #f5f4f5;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            width: 120px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .card:hover {
            border-color: #27ae60; 
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.2);
        }
        .card h3 {
            margin: 10px 0 0 0;
            font-size: 16px;
        }
        .icon {
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>MathQuest</h1>
        <p>Please select your portal to login:</p>
        
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
                <div class="icon">🏪</div>
                <h3>Teacher</h3>
            </a>
        </div>
    </div>

</body>
</html>