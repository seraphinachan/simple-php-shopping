<?php

// 2024.04.09 김지연 수정

// $servername = "localhost";
// $username = "user";
// $password = "jiyeonyee0312";
// $dbname = "shopping";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "shopping";

// $conn = mysqli_connect($servername, $username, $password, $dbname);
// mysqli_set_charset($conn, "utf8mb4");

// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }

require_once __DIR__ . '/vendor/autoload.php'; // Composer autoload

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8mb4");

?>
