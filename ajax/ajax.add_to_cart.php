<?php
session_start();
include('../dbconfig.php');

if (!isset($_SESSION['user_id'])) {
  // Redirect user to login page or display error message
  echo "<script>
      alert('로그인이 필요합니다.');
      window.location.href='login.php';
    </script>";
} else {
  if (isset($_SESSION['user_id'])) {
    if (isset($_POST['cart'])) {
      $product_id = $_POST['product_id'];
      $product_qty = $_POST['product_qty'];
      $userid = $_SESSION['user_id'];
      $product_image = $_POST['product_image'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];

      $chk_existing_cart = "SELECT * FROM cart WHERE product_id='$product_id' AND user_id='$userid'";
      $chk_existing_cart_run = mysqli_query($conn, $chk_existing_cart);

      if (mysqli_num_rows($chk_existing_cart_run) > 0) {
        echo json_encode(array("status" => "existing"));
      } else {
        $insert_query = "INSERT INTO cart (user_id, product_id, product_name, product_image, product_qty, product_price) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssssii", $userid, $product_id, $product_name, $product_image, $product_qty, $product_price);
        if ($stmt->execute()) {
          echo json_encode(array("status" => "added"));
        } else {
          echo json_encode(array("status" => "error"));
        }
      }
    } else {
      echo "카트가 없습니다.";
    }
  } else {
    echo "세션이 없습니다.";
  }
}
?>
