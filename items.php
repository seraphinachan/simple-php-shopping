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
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <?php
    include('header.php');
  ?>

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
                  <form action="buy.php">
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

  <?php
    include('footer.php');
  ?>
</body>
</html>

<script>
  const view = document.querySelectorAll("#view")
  view.forEach( (box) => {
    box.addEventListener("click", () => {
      self.location.href='view.php?idx=' + box.dataset.idx
    })
  })
</script>
