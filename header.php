<?php
  session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Shopping</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="items.php">전체 상품</a>
        </li>
      </ul>
      <!-- <div class="d-flex">
        <?php
          $count = 0;
          if(isset($_SESSION['cart']))
          {
          $count = count($_SESSION['cart']);
          }
        ?>

        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" onclick="location.href='login.php'">
            로그인
        </button>
        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" onclick="location.href='register.php'">
            회원가입
        </button>
        <a href="mycart.php" type="button" class="btn btn-outline-success shadow-none me-lg-3 me-2">
          장바구니 (<?php echo $count; ?>)
        </a>
      </div> -->

      <div class="d-flex">
        <?php
          $count = 0;
          if(isset($_SESSION['cart']))
          {
          $count = count($_SESSION['cart']);
          }
        ?>

        <?php
          if ($_SESSION['user_id']) {?>
            <a href="mycart.php" type="button" class="btn btn-outline-success shadow-none me-lg-3 me-2">
              장바구니 (<?php echo $count; ?>)
            </a>
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" onclick="location.href='mypage.php'">
                마이페이지
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" onclick="location.href='logout.php'">
                로그아웃
            </button>
          <?php
           }else{
          ?>
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" onclick="location.href='login.php'">
                로그인
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" onclick="location.href='register.php'">
                회원가입
            </button>
          <?php
          }
          ?>
      </div>
    </div>
  </div>
</nav>
