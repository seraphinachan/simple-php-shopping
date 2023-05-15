<?php
$servername = "localhost";
$username = "user";
$password = "jiyeonyee0312";
$dbname = "shopping";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
