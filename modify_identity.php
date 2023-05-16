<?php
session_start();
require('dbconfig.php');

$userid = (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') ? $_SESSION['user_id'] : '';

if($userid == '') {
  echo 
  "
  <script>
    alert('잘못된 접근 입니다.');
    self.location.href='index.php'; 
  </script>
  ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
  .inputId #result {
    display: none;
  }
  </style>

</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <?php
    include('header.php');
  ?>

  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <!-- 해당하는 아이디 가져오기 -->
            <?php
              $query = "SELECT * FROM user_info WHERE user_id = ?";
              $stmt = $conn->prepare($query);
              $stmt->bind_param('s', $userid);
              $stmt->execute();
              $result = $stmt->get_result();
              $user_array = $result->fetch_assoc();
            ?>

            <h3 class="mb-3">개인 정보 수정</h3>
            <i class="bi bi-people-fill fs-1 me-6"></i>
            <form action="regist_ok.php" method="POST" name="registform" id="regist_form">
              <div class="row align-items-end inputId">
              <div class="col-md-6 mb-3 mt-3">
                <fieldset disabled>
                  <input type="text" id="disabledTextInput" value="<?= $user_array['user_id']; ?>" class="form-control" >
                </fieldset>
              </div>
              <p class="text-start" id="result">&nbsp;</p>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" id="username" name="username" value="<?= $user_array['user_name']; ?>">
                </div>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-3">
                    <input type="password" class="form-control" id="userpass" name="userpass" placeholder="비밀번호" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <input type="password" class="form-control" id="checkpass" name="checkpass" placeholder="비밀번호 확인" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <input type="text" class="form-control" value="<?= $user_array['user_email']; ?>" id="useremail" name="useremail" placeholder="이메일" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <input type="text" oninput="autoHyphen2(this)" maxlength="13" class="form-control" id="usertel" name="usertel" placeholder="전화번호">
                  </div>
                </div>
                <div class="row align-items-end inputId">
                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" id="postcode" name="postcode" placeholder="우편번호" required>
                </div>
                <div class="col-md-6 mb-3" style="width:100px;">
                  <input type="button" onclick="execDaumPostcode()" value="우편번호 찾기">
                </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <input type="text" class="form-control" id="roadAddress" name="roadAddress" placeholder="도로명주소" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <input type="text" class="form-control" id="jibunAddress" name="jibunAddress" placeholder="지번주소" required>
                    <span id="guide" style="color:#999;display:none"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <input type="text" class="form-control" id="detailAddress" name="detailAddress" placeholder="상세주소" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <input type="text" class="form-control" id="extraAddress" name="extraAddress" placeholder="참고항목" required>
                  </div>
                </div>


                <div class="text-center mt-2 my-1">
                  <button type="submit" class="btn btn-outline-dark shadow-none mb-3">회원가입</button>
                </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

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
