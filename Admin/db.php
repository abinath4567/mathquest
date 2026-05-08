<?php
$conn = new mysqli("localhost","root","","mathquest");

if($conn->connect_error){
die("Connection failed");
}
?>