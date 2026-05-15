<?php
session_start();
include "db.php";

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Learning Progress</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

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
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    min-height:100vh;
    padding:40px;
}

.container{
    max-width:1000px;
    margin:auto;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(12px);
    padding:30px;
    border-radius:20px;
    color:white;
    box-shadow:0 8px 25px rgba(0,0,0,0.3);
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
}

h2{
    font-size:30px;
}

.back{
    text-decoration:none;
    background:white;
    color:#2a5298;
    padding:10px 15px;
    border-radius:10px;
    font-weight:600;
}

.search{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    margin-bottom:20px;
    outline:none;
}

table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:15px;
}

th{
    background:rgba(255,255,255,0.2);
    padding:15px;
}

td{
    padding:15px;
    text-align:center;
    background:rgba(255,255,255,0.08);
    border-bottom:1px solid rgba(255,255,255,0.1);
}

tr:hover td{
    background:rgba(255,255,255,0.15);
}

.progress{
    width:100%;
    background:#ddd;
    border-radius:20px;
    overflow:hidden;
    height:20px;
}

.fill{
    height:100%;
    color:white;
    font-size:12px;
    line-height:20px;
    font-weight:bold;
}

.high{
    background:#00c853;
}

.medium{
    background:#ff9800;
}

.low{
    background:#ff5252;
}

</style>
</head>

<body>

<div class="container">

    <div class="top">

        <h2>
            <i class="fa-solid fa-chart-line"></i>
            Learning Progress
        </h2>

        <a href="teacher_dashboard.php" class="back">
            ← Dashboard
        </a>

    </div>

    <input 
    type="text" 
    id="search"
    class="search"
    placeholder="Search student or topic..."
    onkeyup="searchTable()">

    <table id="table">

        <tr>
            <th>Student</th>
            <th>Topic</th>
            <th>Progress</th>
        </tr>

        <?php

        $sql = "SELECT s.name, t.topic_name, p.progress_percent
                FROM progress p
                JOIN student s ON p.student_id=s.student_id
                JOIN topic t ON p.topic_id=t.topic_id";

        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){

            $progress = $row['progress_percent'];

            if($progress >= 80){
                $class = "high";
            }
            elseif($progress >= 50){
                $class = "medium";
            }
            else{
                $class = "low";
            }

            echo "
            <tr>
                <td>{$row['name']}</td>

                <td>{$row['topic_name']}</td>

                <td>
                    <div class='progress'>
                        <div class='fill $class'
                        style='width:{$progress}%'>
                            {$progress}%
                        </div>
                    </div>
                </td>
            </tr>";
        }

        ?>

    </table>

</div>

<script>

function searchTable(){

    let input = document.getElementById("search").value.toLowerCase();

    let tr = document.getElementById("table").getElementsByTagName("tr");

    for(let i=1; i<tr.length; i++){

        let student = tr[i].getElementsByTagName("td")[0];
        let topic = tr[i].getElementsByTagName("td")[1];

        if(student.innerHTML.toLowerCase().includes(input) ||
           topic.innerHTML.toLowerCase().includes(input)){

            tr[i].style.display = "";
        }
        else{
            tr[i].style.display = "none";
        }
    }
}

</script>

</body>
</html>