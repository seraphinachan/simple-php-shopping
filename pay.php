<?php
  session_start();

  require('dbconfig.php');

  if(mysqli_connect_error()){
    echo "<script>
      alert('데이터 베이스에 연결할 수 없습니다.');
      window.location.href='mycart.php';
    </script>";
    exit();
  }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST['purchase']))
    {
    print_r($_POST);
    }
  }
?>