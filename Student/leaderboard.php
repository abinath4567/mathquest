<?php
include 'db.php';

// CHECK CONNECTION
if (!$conn) {
    die("Database connection failed");
}

// FETCH DATA
$res = $conn->query("SELECT username, points FROM users ORDER BY points DESC");

if (!$res) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    height: 100vh;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    display: flex;
    flex-direction: column;
    align-items: center;
    color: white;
}

/* TITLE */
h1 {
    margin-top: 40px;
    font-size: 3em;
}

/* BOX */
.table-box {
    margin-top: 40px;
    background: white;
    border-radius: 20px;
    padding: 20px;
    width: 80%;
    max-width: 900px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

/* HEADER */
th {
    background: #4CAF50;
    color: white;
    padding: 15px;
    font-size: 1.2em;
}

/* ROWS */
td {
    text-align: center;
    padding: 15px;
    font-size: 1.1em;
    color: #333; /* 🔥 FIX: force dark text */
}

/* STRIPE */
tr:nth-child(even) {
    background: #f2f2f2;
}

/* HOVER */
tr:hover {
    background: #d4f5d3;
}

/* BACK BUTTON */
.back {
    margin-top: 20px;
    text-decoration: none;
    background: #ffffff30;
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
}
</style>

</head>

<body>

<h1>Leaderboard</h1>

<div class="table-box">

<table>
<tr>
    <th>Rank</th>
    <th>Name</th>
    <th>Points</th>
</tr>

<?php
$i = 1;

if ($res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
?>
<tr>
    <td><?php echo $i++; ?></td>
    <td><?php echo htmlspecialchars($row['username']); ?></td>
    <td><?php echo $row['points']; ?></td>
</tr>
<?php
    }
} else {
?>
<tr>
    <td colspan="3">No data found</td>
</tr>
<?php } ?>

</table>

</div>

<a href="Dashboard.php" class="back">⬅ Back to Dashboard</a>

</body>
</html>