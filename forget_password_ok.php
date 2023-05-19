<?php

require('dbconfig.php');

$user_id = $_POST['userid'];
$user_email = $_POST['useremail'];

// db 에 입력한 데이터가 있는지 확인
$query = "SELECT * FROM user_info WHERE user_id = ? AND user_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $user_id, $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 데이터가 있는 경우
    function getRandStr($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $new_password = '';
        for ($i = 0; $i < $length; $i++) {
            $new_password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $new_password;
    }

    $new_password = getRandStr(); // Generate new password
    $update_password_query = "UPDATE user_info SET user_pass = ? WHERE user_id = ? AND user_email = ?";
    $update_stmt = $conn->prepare($update_password_query);
    $update_stmt->bind_param("sss", $new_password, $user_id, $user_email);
    $update_result = $update_stmt->execute();

    if ($update_result) {
        // Send email notification
        $to = $user_email;
        $subject = "새로운 비밀번호를 확인해 주세요.";
        $message = "새로운 비밀번호는 $new_password 입니다.<br>새로운 비밀번호로 로그인을 하신 후에 마이 페이지에서 비밀번호를 수정해 주세요.";
        $headers = "From: jiyeonyee0312@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "<script>
                alert('제출하신 이메일 주소로 새로운 비밀번호 정보를 발송했습니다.');
                window.location.href='index.php';
              </script>";
        } else {
            echo "<script>
              alert('오류가 발생했습니다. 다시 시도해 주세요.');
              window.location.history.back();
            </script>";
        }
    } else {
        echo "<script>
          alert('오류가 발생했습니다. 다시 시도해 주세요.');
          window.location.history.back();
        </script>";
    }
} else {
    // 데이터가 없는 경우
    // echo "데이터가 없습니다.";
    echo "<script>alert('죄송합니다. 입력하신 아이디 또는 이메일 주소를 잘못 입력하셨습니다.');";
    echo "window.location.replace('forget_password.php');</script>";
}

// Close the database connection
$conn->close();
?>
