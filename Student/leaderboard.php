<?php
include 'db.php';

$result = $conn->query("SELECT username, points FROM users ORDER BY points DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>

<style>
body {
    font-family: Poppins;
    background: #e8f5e9;
    text-align: center;
}

.table-box {
    background: white;
    width: 500px;
    margin: 80px auto;
    padding: 30px;
    border-radius: 15px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
}

th {
    background: #4CAF50;
    color: white;
}
</style>
</head>

<body>

<div class="table-box">
<h2>Leaderboard</h2>

<table border="1">
<tr>
<th>Rank</th>
<th>Name</th>
<th>Points</th>
</tr>

<?php 
$rank = 1;
while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $rank++; ?></td>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['points']; ?></td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>