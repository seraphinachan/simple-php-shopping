<?php
  require('dbconfig.php');
  require('lib.php');
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
    .yellow {
      color: #FFD700;
    }
  </style>

</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Option 1: Include in HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <?php
    include('header.php');
  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2">

        <!-- 사이드 바 -->
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light rounded" style="width: 280px;">
          <div class="d-flex flex-column my-auto">
            <span class="fs-4">검색 필터</span>
            <hr>
            <div class="list-group" id="rating_filter">
              <button type="button" class="list-group-item list-group-item-action active" id="all" data-rating="all">
                전체 별점
              </button>
              <button type="button" class="list-group-item list-group-item-action" id="four_star" data-rating="4">
                4점 이상
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star"></i>
              </button>
              <button type="button" class="list-group-item list-group-item-action" id="three_star" data-rating="3">
                3점 이상
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
              </button>
              <button type="button" class="list-group-item list-group-item-action" id="two_star" data-rating="2">
                2점 이상
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
              </button>
              <button type="button" class="list-group-item list-group-item-action" id="one_star" data-rating="1">
                1점 이상
                <i class="bi bi-star-fill yellow"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
              </button>
            </div>
            <hr>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action active">
                전체 가격
              </a>
              <button type="button" class="list-group-item list-group-item-action">1만원 이상</button>
              <button type="button" class="list-group-item list-group-item-action">5천원 ~ 1만원</button>
              <button type="button" class="list-group-item list-group-item-action">1천원 ~ 5천원</button>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-9">
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR PRODUCTS</h2>
        <div class="container">
          <div class="row">

            <?php
              // 페이징 처리
              $limit = 4;
              $page_limit = 5;

              $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
              $start = ($page - 1) * $limit;

              $query = "SELECT COUNT(*) cnt FROM products";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              $result = $stmt->get_result();
              $row = $result->fetch_assoc();
              $total = $row['cnt'];

              // 전체 상품 보여주기
              $query = "SELECT * FROM products ORDER BY idx DESC LIMIT $start, $limit";
              $result = mysqli_query($conn, $query);

              if(mysqli_num_rows($result) > 0)
              {
                foreach ($result as $row) {
            ?>

            <div class="col-lg-3 col-md-6 my-3">
              <div class="card border-0 shadow" style="max-width: 280px; margin: auto;">
                <img src="./data/seller_upload/<?= $row['image']; ?>" data-idx="<?= $row['idx']; ?>" class="card-img-top" id="view" style="max-width: 280px; max-height: 190px; cursor: pointer;">
                <div class="card-body">
                  <h5 class="text-center"><?= $row['name']; ?></h5>
                  <h5 class="text-center"><?= $row['price']; ?> 원</h5>
                  <div class="d-grid gap-2 col-8 mx-auto">
                    <div class="text-center">
                      <div class="mb-3 text-center">
                        <?php
                          $rating = $row['rating'];

                          // 별점에 따라 아이콘 생성
                          for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                              echo '<i class="bi bi-star-fill yellow"></i>';
                            } else {
                              echo '<i class="bi bi-star"></i>';
                            }
                          }
                        ?>
                      </div>
                        <form action="pay_now.php">
                          <input type="hidden" name="idx" value="<?= $row['idx']; ?>">
                          <input type="hidden" name="image" value="<?= $row['image']; ?>">
                          <input type="hidden" name="name" value="<?= $row['name']; ?>">
                          <input type="hidden" name="price" value="<?= $row['price']; ?>">
                          <input type="hidden" name="qty" value="1">
                          <button type="submit" class="btn btn-outline-dark shadow-none">
                            바로 구매하기
                          </button>
                        </form>
                      </div>
                    <div class="text-center">
                      <form action="manage_cart.php" method="POST">
                        <input type="hidden" name="idx" value="<?= $row['idx']; ?>">
                        <input type="hidden" name="image" value="<?= $row['image']; ?>">
                        <input type="hidden" name="name" value="<?= $row['name']; ?>">
                        <input type="hidden" name="price" value="<?= $row['price']; ?>">
                        <input type="hidden" name="qty" value="1">
                        <button type="submit" name="Add_To_Cart" class="btn btn-outline-dark shadow-none">
                          장바구니 추가
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
                }
              } else {
                echo "<h5>등록된 상품이 없습니다.</h5>";
              }
            ?>

          </div>
        </div>

        <!-- 페이징 처리 -->
        <div class="text-center mt-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <?php
                $rs_str = my_pagination($total, $limit, $page_limit, $page, $param);
                echo $rs_str;
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <?php
    include('footer.php');
  ?>
</body>
</html>

<script>
  const view = document.querySelectorAll("#view")
  view.forEach((box) => {
    box.addEventListener("click", () => {
      self.location.href = 'view.php?idx=' + box.dataset.idx
    })
  })
</script>

<!-- 별점 선택 필터 -->
<script>
  document.getElementById("four_star").onclick = function() {
    
  }
</script>
