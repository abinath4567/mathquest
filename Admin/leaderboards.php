<?php
$conn = mysqli_connect("localhost", "root", "", "mathquest");


$sql = "SELECT name, points FROM students ORDER BY points DESC";
$result = mysqli_query($conn, $sql);


echo "<h2>Leaderboard</h2>";

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['name'] . " - " . $row['points'] . " points<br>";
}

mysqli_close($conn);
?>
