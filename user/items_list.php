<?php
include '../dbconfig.php';
include '../lib.php';

// $item_code = (isset($_GET['item_code']) && $_GET['item_code'] != '') ? $_GET['item_code'] : '';

// $item_code = 'item';

include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <style>
      .custom-img-size {
        object-fit: cover; /* Ensure the image covers the entire container */
        height: 200px; /* Set the height of the image as desired */
      }
      .fade-in-box {
        animation: fadein 3s;
      }
      @keyframes fadein {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }
    </style>
</head>

<body>
<?php
  include '../header.php';
?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      <h1 class="heading">전체 상품</h1>

      <?php
        // 전체 상품 수 구하기
        $sql = "SELECT COUNT(*) cnt FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total = $row['cnt'];
      ?>

      <p>전체 상품 수 : <?php echo $total; ?> 개 </p>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 justify-content-center">
      <?php

        // 페이징 처리
        $limit = 4;
        $page_limit = 5;

        $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $sql = "SELECT COUNT(*) cnt FROM products WHERE item_code='".$item_code."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total = $row['cnt'];

        // 전체 상품 보여주기
        $sql = "SELECT * FROM products WHERE item_code='".$item_code."' ORDER BY idx DESC LIMIT $start, $limit";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); // Changed fetchAll() to get_result() to fetch result set
        $rs = $result->fetch_all(MYSQLI_ASSOC); // Changed fetchAll() to fetch_all() to fetch associative array

        if (count($rs) > 0) { // Changed rowCount() to count() to check the number of rows
          foreach ($rs as $row) {
      ?>

      <!-- sql products
      CREATE TABLE products(
        name varchar(20) NOT NULL,

      ) -->

        <div class="col mb-5">
          <div class="card h-100" data-idx="<?= $row['idx']; ?>" id="view_detail" data-code="<?= $item_code; ?>">
            <form class="" action="" method="post">
              <img class="card-img-top custom-img-size" src="../data/seller_upload/<?= $row['photo']; ?>" alt="" />
              <div class="card-body p-4">
                <div class="text-center">
                  <h5 class="fw-bolder"><?= $row['name']; ?></h5>
                  <?= $row['price']; ?> 원
                  <input type="number" class="item_qty" name="item_qty" maxlength="2" min="1" value="1" max="99" required>
                </div>
              </div>
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center d-grid gap-2">
                  <a class="btn btn-outline-dark mt-auto" href="checkout.php?get_id=<?= $row['name']; ?>">바로 구매하기</a>
                  <button class="btn btn-outline-dark mt-auto" type="button" id="btn_submit">장바구니 담기</button>
                </div>
              </div>
            </form>
          </div>
        </div>

      <?php
          }
        } else {
          echo '상품을 찾을 수 없습니다!';
        }
      ?>
      </div>

      <?php
        $param = '&item_code=' . $item_code;

        $rs_str = my_pagination($total, $limit, $page_limit, $page, $param);
        echo $rs_str;
      ?>

    </div>
  </section>

  <script>
    const view_detail = document.querySelectorAll("#view_detail")
    view_detail.forEach( (box) => {
      box.addEventListener("click", () => {
        self.location.href='./product_view.php?idx=' + box.dataset.idx + '&item_code=' + box.dataset.code
      })
    })
  </script>

</body>

</html>
