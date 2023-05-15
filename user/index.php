<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <?php
    include('header.php');
  ?>

  <!-- 이미지 슬라이드 -->
  <div id="index-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../css/images/carousel/2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../css/images/carousel/3.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../css/images/carousel/4.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
  </div>

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR PRODUCTS</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 280px; margin: auto;">
          <div class="card" style="width: 18rem;">
            <img src="../css/images/carousel/1.jpg" class="card-img-top">
            <div class="card-body">
              <h5 class="text-center">상품명</h5>
              <div class="d-grid gap-2 col-8 mx-auto">
                <button type="button" class="btn btn-outline-dark shadow-none" onclick="location.href='register.php'">
                    바로 구매하기
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" onclick="location.href='register.php'">
                    장바구니 담기
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 280px; margin: auto;">
          <div class="card" style="width: 18rem;">
            <img src="../css/images/carousel/1.jpg" class="card-img-top">
            <div class="card-body">
              <h5 class="text-center">상품명</h5>
              <div class="d-grid gap-2 col-8 mx-auto">
                <button type="button" class="btn btn-outline-dark shadow-none" onclick="location.href='register.php'">
                    바로 구매하기
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" onclick="location.href='register.php'">
                    장바구니 담기
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 280px; margin: auto;">
          <div class="card" style="width: 18rem;">
            <img src="../css/images/carousel/1.jpg" class="card-img-top">
            <div class="card-body">
              <h5 class="text-center">상품명</h5>
              <div class="d-grid gap-2 col-8 mx-auto">
                <button type="button" class="btn btn-outline-dark shadow-none" onclick="location.href='register.php'">
                    바로 구매하기
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" onclick="location.href='register.php'">
                    장바구니 담기
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 text-center mt-5">
        <a href="items.php" class="btn btn-light shadow-none">더보기</a>
      </div>

    </div>
  </div>


  <?php
    include('footer.php');
  ?>
</body>
</html>
