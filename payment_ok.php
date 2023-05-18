<?php
session_start();
require('dbconfig.php');

// print_r($_POST);

$order_id = date("Ymd") ."_". substr(md5(microtime().mt_rand(1000,2000)),0,6); // 15자
$user_name = $_POST['user_name'];
$user_tel = $_POST['user_tel'];
$user_email = $_POST['user_email'];
$postcode = $_POST['postcode'];
$roadAddress = $_POST['roadAddress'];
$jibunAddress = $_POST['jibunAddress'];
$detailAddress = $_POST['detailAddress'];
$extraAddress = $_POST['extraAddress'];
$pay_method = $_POST['pay_method'];
$product_image = $_POST['product_image'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_qty = $_POST['product_qty'];
$total_price = $_POST['total_price'];
$shipping_cost = $_POST['shipping_cost'];
$grand_total = $_POST['grand_total'];
$progress = "결제 대기";

// $order_id = date("Ymd") ."_". substr(md5(microtime().mt_rand(1000,2000)),0,6); // 15자
// echo "order_idx1 = $order_idx;

$purchase_query = "INSERT INTO purchase(order_id, user_name, user_tel, user_email, postcode, roadAddress, jibunAddress, detailAddress, extraAddress, pay_method, product_image, product_name, product_price, product_qty, total_price, shipping_cost, grand_total, progress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

try {
    $prepareStmt = mysqli_stmt_prepare($stmt, $purchase_query);
    if (!$prepareStmt) {
        throw new Exception("오류가 발생하였습니다. 다시 시도해주세요.");
    }
    mysqli_stmt_bind_param($stmt, "ssssssssssssssiiis", $order_id, $user_name, $user_tel, $user_email, $postcode, $roadAddress, $jibunAddress, $detailAddress, $extraAddress, $pay_method, $product_image, $product_name, $product_price, $product_qty, $total_price, $shipping_cost, $grand_total, $progress);
    mysqli_stmt_execute($stmt);

    $user_id = $_SESSION['user_id'];

    // 데이터를 table purchase 에 insert 하고 뒤에 table cart 에서 delete 하기
    $delete_query = "DELETE FROM cart WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $delete_query);

    if($result)
      {
        echo "<script>
            alert('결제 성공');
            window.location.href='receipt.php';
          </script>";
      }else{
        echo "<script>
          alert('오류가 발생했습니다. 다시 시도해 주세요.');
          window.location.history.back();
        </script>";
      }

    exit;
} catch (Exception $e) {
    die($e->getMessage());
}
?>
