<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathQuest - Student Portal</title>

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
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-direction: column;
        }

        .btn {
            display: block;
            padding: 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        /* Login Button */
        .btn-login {
            background-color: #4CAF50;
            color: white;
            border: 2px solid #4CAF50;
        }

        .btn-login:hover {
            background-color: #388E3C;
            border-color: #388E3C;
            transform: translateY(-2px);
        }

        /* Register Button */
        .btn-register {
            background-color: transparent;
            color: #4CAF50;
            border: 2px solid #4CAF50;
        }

        .btn-register:hover {
            background-color: #e8f5e9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>MathQuest</h1>
        <p>Gamified Learning System for Primary School Mathematics</p>

        <div class="action-buttons">

            <a href="SignIn.php" class="btn btn-login">
                Login to Dashboard
            </a>

            <a href="Signup.php" class="btn btn-register">
                Register New Account
            </a>

        </div>
    </div>

</body>
</html>