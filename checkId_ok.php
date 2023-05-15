<?php
  require_once('dbconfig.php');
  $userid = $_GET['userid'];
  $sql = "SELECT idx FROM user_info where user_id='$userid'";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_array($result);
  echo isset($data['idx']) ? "X" : "O";
?>
