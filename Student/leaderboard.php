<?php
include 'db.php';
$res = $conn->query("SELECT username, points FROM users ORDER BY points DESC");
?>

<!DOCTYPE html>
<html>
<head>
<style>
body { font-family:Poppins; text-align:center; background:#e8f5e9; }

table {
    margin:80px auto;
    background:white;
    border-collapse:collapse;
}

th,td { padding:10px 20px; }

th { background:#4CAF50; color:white; }
</style>
</head>

<body>

<h2>Leaderboard</h2>

<table border="1">
<tr><th>Rank</th><th>Name</th><th>Points</th></tr>

<?php $i=1; while($r=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $r['username']; ?></td>
<td><?php echo $r['points']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>