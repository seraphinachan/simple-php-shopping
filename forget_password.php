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

          <form action="forget_password_ok.php" method="POST">
            <h3 class="mb-3">비밀번호 찾기</h3>
            <i class="bi bi-key fs-1 me-6"></i>

            <div class="form-outline mb-4 mt-4">
              <input type="text" id="userid" name="userid" class="form-control" placeholder="아이디" />
            </div>

            <div class="form-outline mb-4">
              <input type="email" id="useremail" name="useremail" class="form-control" placeholder="이메일" />
            </div>

            <div id="passwordHelp" class="form-text">새로운 비밀번호가 전송될 이메일은 회원가입 당시에 입력한 정보와 관련된 이메일 주소로 입력해주세요.</div>

            <button class="btn btn-outline-dark shadow-none mb-3 mt-4" type="submit">제출하기</button>
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
