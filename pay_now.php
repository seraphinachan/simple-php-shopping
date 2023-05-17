<?php
  session_start();
  require('dbconfig.php');

  $userid = (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') ? $_SESSION['user_id'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    hr.total_line {
      background-color: #fff;
      border-top: 2px dashed #8c8b8b;
    }
  </style>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- 헤더 -->
  <?php
    include('header.php');
  ?>


  <form action="payment_ok.php" method="POST">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light my-5">
          <h1>PURCHASE</h1>
        </div>

        <div class="col-lg-7">
          <h5>주문자 정보</h5>
          <div class="card my-3">
            <div class="card-body">
              <?php
                $query = "SELECT * FROM user_info WHERE user_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s', $userid);
                $stmt->execute();
                $result = $stmt->get_result();
                $user_array = $result->fetch_assoc();
              ?>

                <div class="container">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">이름</label>
                      <input type="text" class="form-control" id="username" name="username" value="<?= $user_array['user_name']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">전화번호</label>
                      <input type="text" oninput="autoHyphen2(this)" maxlength="13" class="form-control" id="usertel" name="usertel" value="<?= $user_array['user_tel']; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">이메일</label>
                      <input type="text" class="form-control" id="useremail" name="useremail" value="<?= $user_array['user_email']; ?>">
                    </div>
                  </div>
                  <div class="row align-items-end inputId">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">우편번호</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?= $user_array['postcode']; ?>">
                  </div>
                  <div class="col-md-6 mb-3" style="width:100px;">
                    <input type="button" onclick="execDaumPostcode()" value="우편번호 찾기">
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label class="form-label">도로명주소</label>
                      <input type="text" class="form-control" id="roadAddress" name="roadAddress" value="<?= $user_array['roadAddress']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label class="form-label">지번주소</label>
                      <input type="text" class="form-control" id="jibunAddress" name="jibunAddress" value="<?= $user_array['jibunAddress']; ?>">
                      <span id="guide" style="color:#999;display:none"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label class="form-label">상세주소</label>
                      <input type="text" class="form-control" id="detailAddress" name="detailAddress" value="<?= $user_array['detailAddress']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label class="form-label">참고항목</label>
                      <input type="text" class="form-control" id="extraAddress" name="extraAddress" value="<?= $user_array['extraAddress']; ?>">
                    </div>
                  </div>
                </div>

            </div>
          </div>

          <h5>결제 수단</h5>
          <div class="card">
            <div class="card-body">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">
                  무통장 입금
                </label>
              </div>
            </div>
          </div>

          <div class="text-center mt-4 my-1">
            <button type="submit" class="btn btn-primary btn-lg">결제하기</button>
          </div>

        </div>

        <div class="col-lg-5">
          <h5>주문 상세</h5>
          <div class="card my-3">
              <div class="card-body">
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                      $idx = $_GET['idx'];
                      $image = $_GET['image'];
                      $name = $_GET['name'];
                      $price = $_GET['price'];
                      $qty = $_GET['qty'];
                  }

                  $total = 0;
                  $delivery_fee = 0;
                  $total = $price * $qty;

                  ?>
                  <div class="container">
                      <div class="row text-center align-items-center">
                          <div class="col card-title"><img src='./data/seller_upload/<?= $image ?>' width='100px;'></div>
                          <div class="col card-title"><?= $name ?></div>
                          <div class="col card-text"><?= $price ?> 원</div>
                          <div class="col card-text"><?= $qty ?></div>
                      </div>
                  </div>
                  <hr class="total_line">
                  <div>주문금액 : <span class="float-end"><?= $price ?> 원</span></div>
              </div>
          </div>
      </div>

      </div>
    </div>

  </form>

  <?php
    include('footer.php');
  ?>

</body>
</html>
