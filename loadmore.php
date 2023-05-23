<?php
require('dbconfig.php');

$limit = 4;
$offset = $_POST['offset'];

$query = mysqli_query($conn, "SELECT * FROM products ORDER BY idx LIMIT $limit OFFSET $offset");

while ($row = mysqli_fetch_array($query)) {
  ?>
  <style>
    .yellow {
      color: #FFD700;
    }
  </style>
  <div class="card border-0 shadow mx-3 my-3" style="width: 280px;">
    <img src="./data/seller_upload/<?= $row['image']; ?>" data-idx="<?= $row['idx']; ?>" class="card-img-top" id="view" style="width: 280px; height: 190px; object-fit: cover; cursor: pointer;">
    <div class="card-body">
      <h5 class="text-center"><?= $row['name']; ?></h5>
      <h5 class="text-center"><?= $row['price']; ?> 원</h5>
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
  <?php
}
?>
