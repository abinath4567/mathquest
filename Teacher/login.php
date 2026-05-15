<?php
session_start();
include "db.php";

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM teacher WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $_SESSION['teacher'] = $email;

        header("Location: teacher_dashboard.php");
        exit();

    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#1e3c72,#2a5298);
            overflow:hidden;
            position:relative;
        }

        /* Background Circles */

        .circle{
            position:absolute;
            border-radius:50%;
            background:rgba(255,255,255,0.1);
            animation:float 6s infinite ease-in-out;
        }

        .circle1{
            width:200px;
            height:200px;
            top:10%;
            left:10%;
        }

        .circle2{
            width:300px;
            height:300px;
            bottom:-50px;
            right:-50px;
        }

        @keyframes float{
            0%{
                transform:translateY(0px);
            }
            50%{
                transform:translateY(-20px);
            }
            100%{
                transform:translateY(0px);
            }
        }

        .login-container{
            width:400px;
            background:rgba(255,255,255,0.12);
            backdrop-filter:blur(15px);
            border:1px solid rgba(255,255,255,0.2);
            border-radius:25px;
            padding:45px;
            box-shadow:0 8px 32px rgba(0,0,0,0.3);
            color:white;
            z-index:1;
        }

        .login-header{
            text-align:center;
            margin-bottom:35px;
        }

        .login-header i{
            font-size:60px;
            margin-bottom:15px;
            color:white;
        }

        .login-header h2{
            font-size:32px;
            margin-bottom:8px;
        }

        .login-header p{
            color:#ddd;
            font-size:14px;
        }

        .input-group{
            position:relative;
            margin-bottom:25px;
        }

        .input-group input{
            width:100%;
            padding:15px 15px 15px 50px;
            border:none;
            border-radius:12px;
            outline:none;
            font-size:15px;
            background:rgba(255,255,255,0.2);
            color:white;
            transition:0.3s;
        }

        .input-group input::placeholder{
            color:#eee;
        }

        .input-group input:focus{
            background:rgba(255,255,255,0.3);
            transform:scale(1.02);
        }

        .input-group i{
            position:absolute;
            left:18px;
            top:17px;
            color:white;
            font-size:16px;
        }

        .login-btn{
            width:100%;
            padding:15px;
            border:none;
            border-radius:12px;
            background:white;
            color:#2a5298;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .login-btn:hover{
            background:#f1f1f1;
            transform:translateY(-3px);
        }

        .extra-links{
            margin-top:20px;
            text-align:center;
            font-size:14px;
        }

        .extra-links a{
            color:white;
            text-decoration:none;
            transition:0.3s;
        }

        .extra-links a:hover{
            text-decoration:underline;
        }

        .error-box{
            margin-top:20px;
            padding:12px;
            background:rgba(255,0,0,0.2);
            border:1px solid rgba(255,0,0,0.5);
            border-radius:10px;
            color:#ffcccc;
            text-align:center;
            font-size:14px;
        }

        @media(max-width:500px){

            .login-container{
                width:90%;
                padding:35px 25px;
            }

        }

    </style>
</head>

<body>

    <!-- Background Animation -->
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>

    <div class="login-container">

        <div class="login-header">
            <i class="fa-solid fa-chalkboard-user"></i>
            <h2>Teacher Login</h2>
            <p>Welcome back! Please login to continue.</p>
        </div>

        <form method="POST" autocomplete="off">

            <!-- Prevent browser autofill -->
            <input type="text" style="display:none">
            <input type="password" style="display:none">

            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>

                <input 
                type="email" 
                name="email" 
                placeholder="Enter your email"
                required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>

                <input 
                type="password" 
                name="password" 
                placeholder="Enter your password"
                required>
            </div>

            <button type="submit" name="login" class="login-btn">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login
            </button>

        </form>

        <div class="extra-links">
            <a href="#">Forgot Password?</a>
        </div>

        <?php if(!empty($error)) { ?>

            <div class="error-box">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?php echo $error; ?>
            </div>

        <?php } ?>

    </div>

</body>
</html>