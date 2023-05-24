<?php
  session_start();
  require('dbconfig.php');

  $search = $_GET['search'];
?>

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

  <!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

  <?php
    include('header.php');
  ?>

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">SEARCH RESULT</h2>
    <div class="container">
      <?php
        include('side_bar.php');
      ?>
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

        // 검색 결과 출력
        if ($search) {
          $search_query = "SELECT * FROM products WHERE name LIKE '%$search%' ORDER BY idx DESC LIMIT $start, $limit";
          $search_stmt = $conn->prepare($search_query);

          if (!$search_stmt->execute()) {
            echo "<script>alert('오류가 발생했습니다. 다시 시도해 주세요.'); history.back();</script>";
            exit;
          }

          $search_result = $search_stmt->get_result();

          if ($search_result->num_rows > 0) {
            while ($row = $search_result->fetch_assoc()) {
              ?>

          <div class="col-lg-3 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 280px; margin: auto;">
              <img src="./data/seller_upload/<?= $row['image']; ?>" data-idx="<?= $row['idx']; ?>" class="card-img-top" id="view" style="max-width: 280px; max-height: 190px; cursor: pointer;">
              <div class="card-body">
                <h5 class="text-center"><?= $row['name']; ?></h5>
                <h5 class="text-center"><?= $row['price']; ?> 원</h5>
                <div class="d-grid gap-2 col-8 mx-auto">
                  <div class="text-center">
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
        }
      ?>
      </div>
    </div>

  <?php
    include('footer.php');
  ?>
</body>
</html>
