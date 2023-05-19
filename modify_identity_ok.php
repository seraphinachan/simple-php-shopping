<?php
session_start();
require('dbconfig.php');

$userid = $_SESSION['user_id']; // 세션에서 현재 사용자의 user_id를 가져옴
$username = $_POST['username'];
$userpass = $_POST['userpass'];
$checkpass = $_POST['checkpass'];
$useremail = $_POST['useremail'];
$usertel = $_POST['usertel'];
$postcode = $_POST['postcode'];
$roadAddress = $_POST['roadAddress'];
$jibunAddress = $_POST['jibunAddress'];
$detailAddress = $_POST['detailAddress'];
$extraAddress = $_POST['extraAddress'];

// 입력한 비밀번호가 일치하는지 확인
if ($userpass != $checkpass) {
    echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
    exit;
}

// print_r($_POST)

$update_query = "UPDATE user_info SET user_pass = ?, user_name = ?, user_email = ?, user_tel = ?, postcode = ?, roadAddress = ?, jibunAddress = ?, detailAddress = ?, extraAddress = ? WHERE user_id = ?";
$update_stmt = $conn->prepare($update_query);
$update_stmt->bind_param("ssssssssss", $userpass, $username, $useremail, $usertel, $postcode, $roadAddress, $jibunAddress, $detailAddress, $extraAddress, $userid);

if (!$update_stmt->execute()) {
    echo "<script>alert('오류가 발생했습니다. 다시 시도해 주세요.'); history.back();</script>";
    exit;
}

echo "<script>alert('개인 정보를 수정했습니다.');";
echo "window.location.replace('index.php');</script>";
exit;

$update_stmt->close();
$conn->close();
?>
