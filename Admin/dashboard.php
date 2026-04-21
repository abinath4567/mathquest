<?php
session_start();

// If not logged in → go back
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - MathQuest</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
            background-color: #ecf0f1;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: rgb(44, 62, 80);
            color: white;
            height: 100vh;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: rgb(52, 152, 219);
        }

        /* Main */
        .main {
            flex: 1;
            padding: 20px;
            background: white;
        }

        h1 {
            color: rgb(44, 62, 80);
        }

        .card {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>MathQuest</h2>

    <a href="dashboard.php">Dashboard</a>

    <?php if ($role == "Teacher"): ?>
        <a href="students.html">Manage Students</a>
        <a href="reports.html">Reports</a>
    <?php endif; ?>

    <?php if ($role == "Student"): ?>
        <a href="#">Play Game</a>
        <a href="#">My Progress</a>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</div>

<!-- Main Content -->
<div class="main">

    <h1>Welcome, <?php echo $username; ?> 👋</h1>
    <p>You are logged in as <b><?php echo $role; ?></b></p>

    <!-- Role-based content -->
    <?php if ($role == "Teacher"): ?>
        <div class="card">
            <h2>Teacher Panel</h2>
            <p>✔ View student performance</p>
            <p>✔ Access reports and statistics</p>
        </div>
    <?php endif; ?>

    <?php if ($role == "Student"): ?>
        <div class="card">
            <h2>Student Panel</h2>
            <p>🎮 Start your MathQuest journey!</p>
            <p>🏆 Earn rewards and badges</p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>