<?php

session_start();
session_destroy();

include 'dbconfig.php';
include 'header.php';

?>
<script>
    alert("로그아웃 되었습니다");
    location.replace('index.php');
</script>
