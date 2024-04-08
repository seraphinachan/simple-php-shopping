<?php
// $servername = "localhost";
// $username = "user";
// $password = "jiyeonyee0312";
// $dbname = "shopping";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
