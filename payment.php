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
                      <input type="text" class="form-control" id="user_name" name="user_name" value="<?= $user_array['user_name']; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">전화번호</label>
                      <input type="text" oninput="autoHyphen2(this)" maxlength="13" class="form-control" id="user_tel" name="user_tel" value="<?= $user_array['user_tel']; ?>">
                    </div>                  
                    <div class="col-md-6 mb-3">
                      <label class="form-label">이메일</label>
                      <input type="text" class="form-control" id="user_email" name="user_email" value="<?= $user_array['user_email']; ?>">
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
                <input class="form-check-input" type="radio" name="pay_method" id="pay_method" value="무통장 입금" checked>
                <label class="form-check-label" for="exampleRadios1">
                  무통장 입금
                </label>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-5">
          <h5>주문 상세</h5>
          <div class="card my-3">
            <div class="card-body">
              <?php
                $order_query = "SELECT * FROM cart WHERE user_id = ?";
                $stmt = $conn->prepare($order_query);
                $stmt->bind_param("s", $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $total = 0;
                $delivery_fee = 0;

                if (mysqli_num_rows($result) > 0) {
                  while ($rs = $result->fetch_assoc()) {
                    $price = $rs['product_price'] * $rs['product_qty']; // 상품 금액 * 상품 수량
                    $total += $price;
                  }

                  if ($total < 30000) {
                    $shipping_cost = 3000;
                  } else {
                    $shipping_cost = 0;
                  }

                  $grand_total = $total + $shipping_cost;

                  // 전체 상품 보여주기
                  mysqli_data_seek($result, 0);
                  while ($rs = $result->fetch_assoc()) {
              ?>
                    <div class="container">
                      <div class="row text-center align-items-center mt-2">
                        <div class="col card-text"><img src='./data/seller_upload/<?= $rs['product_image'] ?>' width='100px;'></div>
                        <div class="col card-text"><?= $rs['product_name'] ?></div>
                        <div class="col card-text"><?= $rs['product_price'] ?> 원</div>
                        <div class="col card-text"><?= $rs['product_qty'] ?></div>
                        <input type="hidden" name="product_image[]" value="<?= $rs['product_image'] ?>">
                        <input type="hidden" name="product_name[]" value="<?= $rs['product_name'] ?>">
                        <input type="hidden" name="product_price[]" value="<?= $rs['product_price'] ?>">
                        <input type="hidden" name="product_qty[]" value="<?= $rs['product_qty'] ?>">
                      </div>        
                    </div>  
              <?php
                  }
              ?>
                  <div class="container">
                    <div class="row">
                      <hr class="total_line mt-4">
                      <div name="total_price">주문금액 : <span class="float-end"><?= $total ?> 원</span></div>
                      <div name="shipping_cost">배송비 : <span class="float-end"><?= $shipping_cost ?> 원</span></div>
                      <div name="grand_total">결제금액 : <span class="float-end"><?= $grand_total ?> 원</span></div>
                      <input type="hidden" name="total_price" value="<?= $total ?>">
                      <input type="hidden" name="shipping_cost" value="<?= $shipping_cost ?>">
                      <input type="hidden" name="grand_total" value="<?= $grand_total ?>">
                    </div>
                  </div>
              <?php
                } else {
                  echo "장바구니에 상품이 없습니다.";
                }
              ?>      
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="text-center mt-4 my-1">
      <input type="hidden" name="progress" value="결제 대기">
      <button type="submit" class="btn btn-primary btn-lg">결제하기</button>
    </div>

  </form>

  <?php
    include('footer.php');
  ?>

</body>
</html>

<!-- 전화번호 입력 -->
  <script>
    const autoHyphen2 = (target) => {
    target.value = target.value
     .replace(/[^0-9]/g, '')
     .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
      }
  </script>

  <!-- 다음 주소 api -->
  <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <script>
      //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
      function execDaumPostcode() {
          new daum.Postcode({
              oncomplete: function(data) {
                  // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                  // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                  // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                  var roadAddr = data.roadAddress; // 도로명 주소 변수
                  var extraRoadAddr = ''; // 참고 항목 변수

                  // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                  // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                  if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                      extraRoadAddr += data.bname;
                  }
                  // 건물명이 있고, 공동주택일 경우 추가한다.
                  if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                  }
                  // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                  if(extraRoadAddr !== ''){
                      extraRoadAddr = ' (' + extraRoadAddr + ')';
                  }

                  // 우편번호와 주소 정보를 해당 필드에 넣는다.
                  document.getElementById('postcode').value = data.zonecode;
                  document.getElementById("roadAddress").value = roadAddr;
                  document.getElementById("jibunAddress").value = data.jibunAddress;

                  // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                  if(roadAddr !== ''){
                      document.getElementById("extraAddress").value = extraRoadAddr;
                  } else {
                      document.getElementById("extraAddress").value = '';
                  }

                  var guideTextBox = document.getElementById("guide");
                  // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                  if(data.autoRoadAddress) {
                      var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                      guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                      guideTextBox.style.display = 'block';

                  } else if(data.autoJibunAddress) {
                      var expJibunAddr = data.autoJibunAddress;
                      guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                      guideTextBox.style.display = 'block';
                  } else {
                      guideTextBox.innerHTML = '';
                      guideTextBox.style.display = 'none';
                  }
              }
          }).open();
      }
  </script>
