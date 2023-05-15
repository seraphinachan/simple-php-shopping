<?php
  session_start();
  require('../dbconfig.php');

  $idx = (isset($_GET['idx']) && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

  if ($idx == '') {
      die('비정상적인 접근은 허용하지 않습니다');
  }

  $sql = "SELECT * FROM products WHERE idx=?";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
      die('SQL error: ' . $conn->error);
  }

  $stmt->bind_param('s', $idx);

  if (!$stmt->execute()) {
      die('SQL error: ' . $stmt->error);
  }

  $result = $stmt->get_result();

  if (!$result) {
      die('SQL error: ' . $stmt->error);
  }

  $row = $result->fetch_assoc();

  if (!$row) {
      die('해당 상품이 존재하지 않습니다');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Icon only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <!-- jquery -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    /* 별점 남기기 */
    .rating-stars input[type="radio"] {
    display: none;
    }

    .rating-stars label {
    display: inline-block;
    cursor: pointer;
    font-size: 2rem;
    color: #ccc;
    }

    .rating-stars {
      direction: rtl;
    }

    .rating-stars label:hover,
    .rating-stars label:hover ~ label,
    .rating-stars input[type="radio"]:checked ~ label {
      color: #FFD700;
    }

    /* 별점 평균 값 나타내기 */
    .main-stars input[type="radio"] {
    display: none;
    }

    .main-stars label {
        font-size: 30px;
        color: #ccc;
    }
  </style>

</head>
<body>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <?php
    include 'header.php';
  ?>

<section class="py-5">
  <div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
      <div class="col-md-6">
        <img class="card-img-top mb-5 mb-md-0" src="../data/seller_upload/<?= $row['image']; ?>">
      </div>
      <div class="col-md-6">
        <div class="row">
          <div div class="d-flex md-6">
          <h1><?= $row['name'] ?></h1>
        </div>
        <div class="d-flex md-6 mt-2">
          <span><?= $row['price'] ?> 원</span>
        </div>
        <div class="d-flex md-6 mt-2">
          <input class="form-control text-center" id="inputqty" type="number" value="1" min="1" style="width:280px;">
        </div>
        <div class="d-flex mb-6 mt-2">
          <span class="">총 상품 금액 : </span>
        </div>
          <div class="d-grid gap-2 col-6 mt-2">
            <form action="manage_cart.php" method="POST">
              <input type="hidden" name="idx" value="<?= $row['idx']; ?>">
              <input type="hidden" name="image" value="<?= $row['image']; ?>">
              <input type="hidden" name="name" value="<?= $row['name']; ?>">
              <input type="hidden" name="price" value="<?= $row['price']; ?>">
              <button class="btn btn-outline-dark shadow-none" type="submit" name="Add_To_Cart">
                <i class="bi-cart-fill me-1"></i>
                장바구니 담기
              </button>
            </form>
            <button class="btn btn-outline-dark shadow-none" type="submit">
              <i class="bi bi-wallet"></i>
              바로 구매하기
            </button>
          </div>
        </div>
      </div>
    </div>


    <!-- 메뉴 -->
    <div class="container mt-5">
      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">상세정보</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">리뷰</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Q$A</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>반품/교환정보</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0"><?= $row['description'] ?></div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <div class="container">
          <div class="card">
            <div class="card-header">상품 후기</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 text-center">
                    <h1 class="text-warning mb-4">
                      <b><span id="average-rating-value"></span> / 5</b>
                    </h1>
                    <div class="mb-3 text-center main-stars">
                      <input type="radio" name="rating" class="star-1" id="star-1" value="5">
                      <label class="star-1" for="star-1"><i class="fas fa-star main-stars"></i></label>
                      <input type="radio" name="rating" class="star-2" id="star-2" value="4">
                      <label class="star-2" for="star-2"><i class="fas fa-star main-stars"></i></label>
                      <input type="radio" name="rating" class="star-3" id="star-3" value="3">
                      <label class="star-3" for="star-3"><i class="fas fa-star main-stars"></i></label>
                      <input type="radio" name="rating" class="star-4" id="star-4" value="2">
                      <label class="star-4" for="star-4"><i class="fas fa-star main-stars"></i></label>
                      <input type="radio" name="rating" class="star-5" id="star-5" value="1">
                      <label class="star-5" for="star-5"><i class="fas fa-star main-stars"></i></label>
                    </div>
                  <h3 class="mb-3"><span id="total-review-value"></span> Review</h3>
                  <button type="button" class="btn btn-dark rounded-pill shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-review">
                    <?php if($_SESSION['user_id']){?>
                       <i class="bi bi-plus-square"></i> 추가
                    <?php
                     }else{
                      alert("로그인한 회원만 후기를 남길 수 있습니다.");
                      window.location.href="login.php";
                    ?>
                    <?php
                    }
                    ?>
                  </button>
                </div>
                <div class="col-md-4 text-center">
                  <div class="progress mt-3">
                    <div class="progress-bar bg-warning" id="five_star_progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="progress mt-4">
                    <div class="progress-bar bg-warning" id="four_star_progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="progress mt-4">
                    <div class="progress-bar bg-warning" id="three_star_progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="progress mt-4">
                    <div class="progress-bar bg-warning" id="two_star_progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="progress mt-4">
                    <div class="progress-bar bg-warning" id="one_star_progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add-review" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form method="post" id="regist_review">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-center" id="staticBackdropLabel">후기 남기기</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="rating-stars text-center">
                      <input type="radio" name="rating" class="star-1" id="star-1" value="5">
                      <label class="star-1" for="star-1"><i class="fas fa-star"></i></label>
                      <input type="radio" name="rating" class="star-2" id="star-2" value="4">
                      <label class="star-2" for="star-2"><i class="fas fa-star"></i></label>
                      <input type="radio" name="rating" class="star-3" id="star-3" value="3">
                      <label class="star-3" for="star-3"><i class="fas fa-star"></i></label>
                      <input type="radio" name="rating" class="star-4" id="star-4" value="2">
                      <label class="star-4" for="star-4"><i class="fas fa-star"></i></label>
                      <input type="radio" name="rating" class="star-5" id="star-5" value="1">
                      <label class="star-5" for="star-5"><i class="fas fa-star"></i></label>
                    </div>
                    <div class="col-md-12 mb-3 mt-3">
                      <input type="text" class="form-control" id="title" name="title" placeholder="후기 제목" required>
                    </div>
                    <div class="col-md-12 mb-3">
                      <textarea class="form-control" placeholder="후기 내용을 입력해주세요." id="content" name="content"></textarea>
                    </div>
                    <input type="hidden" name="productid" value="<?= $row['idx'] ?>">
                    <!-- <input type="hidden" name="userid" value="<?= $_SESSION['user_id'] ?>"> -->
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                    <button type="button" class="btn btn-primary" id="regist_review_btn">등록</button>
                </div>

                <script>
                    $(document).ready(function(){
                        // On form submission
                        $('#regist_review_btn').click(function(e){
                            e.preventDefault(); // prevent default form submit

                            // Get the form data
                            var formData = $('#regist_review').serialize();
                            // console.log(formData);
                            // return false;
                            $.ajax({
                                url: './ajax/ajax.review_write.php',
                                type: 'POST',
                                data: formData,
                                success: function(response) {
                                    console.log(response);
                                    $('#add-review').modal('hide');
                                    $('#regist_review')[0].reset();
                                    // var json_data = JSON.parse(response);
                                    // console.log(json_data.average_rating);
                                    // $('#average-rating-value').html(response.average_rating);
                                    load_rating_data();

                                    alert("후기가 등록되었습니다.");
                                    return false;
                                    // Close the modal
                                    // $('#add-review').modal('hide');
                                    // // Clear the form
                                    // $('#regist_review')[0].reset();
                                    // // Display success message
                                    // alert("후기가 등록되었습니다.");
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                    alert("후기 등록에 실패했습니다. 잠시 후 다시 시도해주세요.");
                                }
                            });
                        });

                    });


                  function load_rating_data()
                  {
                    $.ajax({
                      url: "./ajax/ajax.review_view.php",
                      method: "post",
                      data: {action: 'load_data'},
                      dataType: "JSON",
                      success: function(data)
                      {
                        console.log(data);
                        // var json_data = JSON.parse(data);
                        console.log(data.average_rating);
                        $('#average-rating-value').html(data.average_rating+"");
                        // $('#average-rating-value').text(data.average_rating);
                        // $('#total-review-value').text(data.total_review);
                      }
                    })
                  }
                  load_rating_data();
                </script>


        <!-- 리뷰 & 별점 시스템 코드 끝 -->
        </div>
          <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
<script>
  // $('#average-rating-value').html("5");
  $('.rating-stars label').on('click', function () {
  var starClass = $(this).attr('class');
  $('input.' + starClass).prop('checked', true);
  });
</script>
