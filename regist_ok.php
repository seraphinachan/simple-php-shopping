<?php

require('dbconfig.php');

$userid = $_POST['userid'];
$userpass = $_POST['userpass'];
$checkpass = $_POST['checkpass'];
$username = $_POST['username'];
$useremail = $_POST['useremail'];
$usertel = $_POST['usertel'];
$postcode = $_POST['postcode'];
$roadAddress = $_POST['roadAddress'];
$jibunAddress = $_POST['jibunAddress'];
$detailAddress = $_POST['detailAddress'];
$extraAddress = $_POST['extraAddress'];

// Check the length of userid
if (strlen($userid) < 4 || strlen($userid) > 12) {
    echo "<script>alert('아이디는 4자 이상 12자 이하로 입력해주세요.'); history.back();</script>";
    exit;
}

// Check the length of userpass
if (strlen($userpass) < 6 || strlen($userpass) > 20) {
    echo "<script>alert('비밀번호는 6자 이상 20자 이하로 입력해주세요.'); history.back();</script>";
    exit;
}

// Check that the passwords match
if ($userpass != $checkpass) {
    echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
    exit;
}

// Prepare the SQL query using a prepared statement
$sql = "INSERT INTO user_info(user_id, user_pass, user_name, user_email, user_tel, postcode, roadAddress, jibunAddress, detailAddress, extraAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
$prepareStmt = mysqli_stmt_prepare($stmt, $sql);

if ($prepareStmt) {
    mysqli_stmt_bind_param($stmt, "ssssssssss", $userid, $userpass, $username, $useremail, $usertel, $postcode, $roadAddress, $jibunAddress, $detailAddress, $extraAddress);
    mysqli_stmt_execute($stmt);
    echo "<script>alert('회원가입이 완료되었습니다.');";
    echo "window.location.replace('index.php');</script>";
    exit;
} else {
    die("오류가 발생하였습니다. 다시 시도해주세요.");
}

?>
