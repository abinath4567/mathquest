<!DOCTYPE html>

<html>

<head>
    <title>Admin Dashboard</title>

```
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        margin: 0;
        font-family: Arial;
        background-color: #ecf0f1;
    }

    /* SIDEBAR */
    .sidebar {
        width: 220px;
        height: 100vh;
        background-color: rgb(44, 62, 80);
        position: fixed;
        color: white;
        padding-top: 20px;
    }

    .sidebar h2 {
        text-align: center;
    }

    .sidebar a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 15px;
    }

    .sidebar a:hover {
        background-color: rgb(52, 73, 94);
    }

    /* MAIN CONTENT */
    .main {
        margin-left: 220px;
        padding: 20px;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    /* TABLE */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: rgb(52, 152, 219);
        color: white;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .pass {
        color: green;
        font-weight: bold;
    }

    .fail {
        color: red;
        font-weight: bold;
    }

    /* STAT BOXES */
    .stats {
        display: flex;
        gap: 20px;
    }

    .stat-box {
        flex: 1;
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .stat-box h3 {
        margin: 0;
        color: rgb(44, 62, 80);
    }

    canvas {
        background: white;
        border-radius: 10px;
        padding: 10px;
    }
</style>
```

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">
    <h2>MathQuest</h2>

```
<a href="#">Dashboard</a>
<a href="#">Students</a>
<a href="#">Reports</a>
<a href="login.html">Logout</a>
```

</div>

<!-- MAIN -->

<div class="main">

```
<h1>Admin Dashboard</h1>

<!-- STATISTICS -->
<div class="stats">

    <div class="stat-box">
        <h3>Total Students</h3>
        <p>3</p>
    </div>

    <div class="stat-box">
        <h3>Average Score</h3>
        <p>66.7</p>
    </div>

    <div class="stat-box">
        <h3>Pass Rate</h3>
        <p>67%</p>
    </div>

</div>

<!-- TABLE -->
<div class="card">
    <h2>Student Performance</h2>

    <table>
        <tr>
            <th>Student Name</th>
            <th>Score</th>
            <th>Status</th>
        </tr>

        <tr>
            <td>Ali</td>
            <td>85</td>
            <td class="pass">Pass</td>
        </tr>

        <tr>
            <td>Brian</td>
            <td>45</td>
            <td class="fail">Fail</td>
        </tr>

        <tr>
            <td>Chong</td>
            <td>70</td>
            <td class="pass">Pass</td>
        </tr>
    </table>
</div>

<!-- BAR CHART -->
<div class="card">
    <h2>Student Scores</h2>
    <canvas id="barChart"></canvas>
</div>

<!-- PIE CHART -->
<div class="card">
    <h2>Pass vs Fail</h2>
    <canvas id="pieChart"></canvas>
</div>
```

</div>

<script>

    // BAR CHART
    new Chart(document.getElementById("barChart"), {
        type: 'bar',

        data: {
            labels: ["Ali", "Brian", "Chong"],

            datasets: [{
                label: "Scores",
                data: [85, 45, 70],
                backgroundColor: [
                    "green",
                    "red",
                    "green"
                ]
            }]
        }
    });

    // PIE CHART
    new Chart(document.getElementById("pieChart"), {
        type: 'pie',

        data: {
            labels: ["Pass", "Fail"],

            datasets: [{
                data: [2, 1],

                backgroundColor: [
                    "green",
                    "red"
                ]
            }]
        }
    });

</script>

</body>
</html>
