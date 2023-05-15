<?php

include '../dbconfig.php';

if(isset($_FILES['item_photo']['name']) && $_FILES['item_photo']['name'] != '')  {
    $upload_file_name = date('YmdHis').'.jpg';
    copy($_FILES['item_photo']['tmp_name'], "../data/seller_upload/" . $upload_file_name);
} else {
    $upload_file_name = ''; // Set default value if file is not uploaded
}

$name     = (isset($_POST['item_name']) && $_POST['item_name'] != '') ? $_POST['item_name'] : '';
$price    = (isset($_POST['item_price']) && $_POST['item_price'] != '') ? $_POST['item_price'] : '';
$qty      = (isset($_POST['item_qty']) && $_POST['item_qty'] != '') ? $_POST['item_qty'] : '';
$content  = (isset($_POST['item_content']) && $_POST['item_content'] != '') ? $_POST['item_content'] : '';
$item_code  = (isset($_POST['item_code']) && $_POST['item_code'] != '') ? $_POST['item_code'] : '';

// Prepare the SQL statement
$sql = "INSERT INTO products (name, price, qty, content, photo, item_code) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $price, $qty, $content, $upload_file_name, $item_code);
$result = $stmt->execute();

$stmt->close();

?>
