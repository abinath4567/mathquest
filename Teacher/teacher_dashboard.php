<?php
session_start();
include "db.php";

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit();
}

$teacherName = $_SESSION['teacher'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            background:linear-gradient(135deg,#1e3c72,#2a5298);
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px;
        }

        .dashboard{
            width:100%;
            max-width:1200px;
            background:rgba(255,255,255,0.1);
            backdrop-filter:blur(12px);
            border-radius:25px;
            padding:40px;
            box-shadow:0 8px 32px rgba(0,0,0,0.3);
            border:1px solid rgba(255,255,255,0.2);
            color:white;
        }

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:40px;
            flex-wrap:wrap;
            gap:20px;
        }

        .welcome h1{
            font-size:36px;
            margin-bottom:10px;
        }

        .welcome p{
            opacity:0.8;
            font-size:16px;
        }

        .profile{
            width:70px;
            height:70px;
            background:white;
            color:#2a5298;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:28px;
            font-weight:bold;
        }

        .stats{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:40px;
        }

        .stat-card{
            background:rgba(255,255,255,0.15);
            padding:25px;
            border-radius:18px;
            transition:0.3s;
            border:1px solid rgba(255,255,255,0.15);
        }

        .stat-card:hover{
            transform:translateY(-5px);
            background:rgba(255,255,255,0.2);
        }

        .stat-card i{
            font-size:32px;
            margin-bottom:15px;
        }

        .stat-card h2{
            font-size:28px;
            margin-bottom:5px;
        }

        .stat-card p{
            opacity:0.8;
        }

        .menu-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:25px;
        }

        .menu-card{
            background:white;
            color:#333;
            text-decoration:none;
            padding:30px;
            border-radius:20px;
            transition:0.3s;
            box-shadow:0 5px 15px rgba(0,0,0,0.15);
            position:relative;
            overflow:hidden;
        }

        .menu-card:hover{
            transform:translateY(-8px) scale(1.02);
        }

        .menu-card i{
            font-size:40px;
            margin-bottom:20px;
            color:#2a5298;
        }

        .menu-card h3{
            margin-bottom:10px;
            font-size:22px;
        }

        .menu-card p{
            color:#666;
            font-size:14px;
        }

        .menu-card::before{
            content:'';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:5px;
            background:linear-gradient(to right,#00c6ff,#0072ff);
        }

        .logout-card::before{
            background:red;
        }

        .logout-card i{
            color:red;
        }

        @media(max-width:768px){

            .top-bar{
                flex-direction:column;
                text-align:center;
            }

            .welcome h1{
                font-size:28px;
            }

        }

    </style>
</head>

<body>

<div class="dashboard">

    <!-- Top Bar -->
    <div class="top-bar">

        <div class="welcome">
            <h1>Welcome, <?php echo $teacherName; ?> 👋</h1>
            <p>Manage students, scores, and learning progress easily.</p>
        </div>

        <div class="profile">
            <?php echo strtoupper(substr($teacherName,0,1)); ?>
        </div>

    </div>

    <!-- Statistics Section -->
    <div class="stats">

        <div class="stat-card">
            <i class="fa-solid fa-users"></i>
            <h2>120</h2>
            <p>Total Students</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-chart-line"></i>
            <h2>87%</h2>
            <p>Average Performance</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-book"></i>
            <h2>15</h2>
            <p>Courses Managed</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <h2>8</h2>
            <p>Need Improvement</p>
        </div>

    </div>

    <!-- Menu Section -->
    <div class="menu-grid">

        <a href="student_scores.php" class="menu-card">
            <i class="fa-solid fa-square-poll-vertical"></i>
            <h3>Student Scores</h3>
            <p>Check all student marks and examination scores.</p>
        </a>

        <a href="leaderboard.php" class="menu-card">
            <i class="fa-solid fa-trophy"></i>
            <h3>Leaderboard</h3>
            <p>View top-performing students ranking.</p>
        </a>

        <a href="learning_progress.php" class="menu-card">
            <i class="fa-solid fa-chart-column"></i>
            <h3>Learning Progress</h3>
            <p>Monitor student progress and activities.</p>
        </a>

        <a href="performance_reports.php" class="menu-card">
            <i class="fa-solid fa-file-lines"></i>
            <h3>Performance Reports</h3>
            <p>Generate detailed student performance reports.</p>
        </a>

        <a href="improvement.php" class="menu-card">
            <i class="fa-solid fa-user-clock"></i>
            <h3>Need Improvement</h3>
            <p>Students requiring extra attention and support.</p>
        </a>

        <a href="logout.php" class="menu-card logout-card">
            <i class="fa-solid fa-right-from-bracket"></i>
            <h3>Logout</h3>
            <p>Securely logout from the dashboard.</p>
        </a>

    </div>

</div>

</body>
</html>