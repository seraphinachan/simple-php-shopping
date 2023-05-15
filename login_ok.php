<?php
session_start();

require ('dbconfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];
    $userpass = $_POST["userpass"];

    $stmt = $conn->prepare("SELECT * FROM user_info WHERE user_id=? AND user_pass=?");
    $stmt->bind_param("ss", $userid, $userpass);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];

        if ($row["user_type"] == "admin") {
            header("Location: ./admin/dashboard.php");
            exit();
        } else if ($row["user_type"] == "user") {
            header("Location: index.php");
            exit();
        }
    } else {
      echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.'); history.back();</script>";
      exit;
    }

    $stmt->close();
    $conn->close();
}
?>
