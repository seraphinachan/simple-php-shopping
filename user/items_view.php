<?php
include '../dbconfig.php';
include '../lib.php';
include '../config.php';

// Check if the database connection is established successfully
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

if ($idx == '') {
    die('비정상적인 접근은 허용하지 않습니다');
}

$sql = "SELECT * FROM products WHERE idx=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $idx);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  <style>
    .rating-color {
      color: #fbc634;
    }
  </style>

  <script>

    
    /* 버튼 클릭 후 모달 코드 시작 */
  //   $(document).ready(function(){
  //     const rating_data = 0;

  //     const exampleModal = document.getElementById('exampleModal')
  //     const myInput = document.getElementById('myInput')
  //     exampleModal.addEventListener('show.bs.modal', event => {
  //       myInput.focus()
  //   });
  // });

    $(document).ready(function(){
      var rating_data = 0;

      $('#add_review').click(function(){
        $('#review_modal').modal('show');
      });

      $(document).on('mouseenter', '.submit_star', function(){
        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {
          $('#submit_star_'+count).addClass('text-warning');
        }
      });

      function reset_background()
      {
        for(var count = 1; count <=5; count++)
        {
          $('#submit_star_'+count).addClass('star-light');

          $('#submit_star_'+count).removeClass('text-warning');
        }
      }

      $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

      });

      $(document).on('click', '.submit_star', function(){
        rating_data = $(this).data('rating');
      });

      $('#save_review').click(function(){

        var user_name = $('#user_name').val();

        var user_pic = $('#user_pic').val();

        var user_review = $('#user_review').val();

        if(user_name == '' || user_review == '')
        {
          alert("후기를 입력해주세요");
          return false;
        }else
        {
          $.ajax({
            url: "submit_rating.php",
            method: "POST",
            data: {rating_data: rating_data, user_name:user_name, user_pic:user_pic, user_review:user_review},
            success:function(data)
            {
              $('#review_modal').modal('hide');
              alert(data);
            }
          })
        }
      });
    });
    
      // Button that triggered the modal
      // const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      // const recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      // const modalTitle = exampleModal.querySelector('.modal-title')
      // const modalBodyInput = exampleModal.querySelector('.modal-body input')

      // modalTitle.textContent = `New message to ${recipient}`
      // modalBodyInput.value = recipient

  
    /* 버튼 클릭 후 모달 코드 끝 */


  </script>
</head>
<body>

<?php
  include '../header.php';
?>

  <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="../data/seller_upload/<?= $row['photo']; ?>" alt="" /></div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: BST-498</div>
                <h1 class="display-5 fw-bolder"><?= $row['name'] ?></h1>
                <div class="fs-5 mb-5">
                  <span class="text-decoration-line-through">$45.00</span>
                  <span><?= $row['price'] ?></span>
                </div>
                <div class="d-flex mb-5">
                  <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 6rem" />  
                </div>
                <div class="mb-5">
                  <span class="">총 상품 금액 : </span>
                </div>
                <div class="d-grid gap-2 col-6">
                      <button class="btn btn-outline-dark flex-shrink-0" type="button">
                          <i class="bi-cart-fill me-1"></i>
                          장바구니 담기
                      </button>
                      <button class="btn btn-outline-dark flex-shrink-0" type="button">
                          <i class="bi-cart-fill me-1"></i>
                          바로 구매하기
                      </button>
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
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0"><?= $row['content'] ?></div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

              <!-- 리뷰 & 별점 시스템 코드 시작 -->
              <div class="container">
                <!-- <h1>User Rating with Review System</h1> -->
                <div class="card">
                  <div class="card-header">상품 후기</div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                          <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>
                        <div class="mb-3">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                        <h3 class="mb-3"><span id="total_review">0</span> Review</h3>
                        <button type="button" class="btn btn-outline-dark" name="add_review" id="add_review" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">후기 남기기</button> <!-- class = add_review -->
                      </div>
                      <div class="col-sm-4">
                        <p>                          
                          <div class="progress-label"><b>5</b><i class="fa fa-star rating-color"></i>(<span id="total_five_star_review">0</span>)</div>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" araia-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                          </div>
                        </p>
                        <p>
                          <div class="progress-label"><b>4</b><i class="fa fa-star rating-color"></i>(<span id="total_four_star_review">0</span>)</div>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" araia-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                          </div>
                        </p>
                        <p>
                          <div class="progress-label"><b>3</b><i class="fa fa-star rating-color"></i>(<span id="total_three_star_review">0</span>)</div>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" araia-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                          </div>
                        </p>
                        <p>
                          <div class="progress-label"><b>2</b><i class="fa fa-star rating-color"></i>(<span id="total_two_star_review">0</span>)</div>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" araia-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                          </div>
                        </p>
                        <p>
                          <div class="progress-label"><b>1</b><i class="fa fa-star rating-color"></i>(<span id="total_one_star_review">0</span>)</div>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" araia-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                          </div>
                        </p>
                      </div>
                      

                        <!-- 버튼 클릭 후 모달 코드 시작 -->

                        <!-- <div class="modal fade" id="review_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> class = review_modal -->
                        <div id="review_modal" class="modal" tabindex="-1" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">상품 후기</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">

                                <!-- 모달 폼 (아이디, 이미지 파일, 텍스트) 시작 -->
                                <form>
                                  <div class="mb-3 row">
                                    <label for="review-user" class="col-sm-2 col-form-label">작성자</label>
                                    <div class="col-sm-10">
                                      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $row['name'] ?>">
                                    </div>
                                  </div>
                                  <div class="text-center mt-2 mb-4">
                                    <i class="fa fa-star submit_star" id="submit_star_1" data-rating="1"></i>
                                    <i class="fa fa-star submit_star" id="submit_star_2" data-rating="2"></i>
                                    <i class="fa fa-star submit_star" id="submit_star_3" data-rating="3"></i>
                                    <i class="fa fa-star submit_star" id="submit_star_4" data-rating="4"></i>
                                    <i class="fa fa-star submit_star" id="submit_star_5" data-rating="5"></i>
                                  </div>
                                  <div class="mb-3">
                                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                  </div>
                                  <div class="mb-3">
                                    <label for="review-text" class="col-form-label">후기</label>
                                    <textarea class="form-control" placeholder="후기를 남겨주세요" id="myInput" style="height: 100px"></textarea>
                                  </div>
                                </form>
                                <!-- 모달 폼 (아이디, 이미지 파일, 텍스트) 끝 -->

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel_review">취소</button>
                                <button type="button" class="btn btn-primary" id="save_review">등록</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- 버튼 클릭 후 모달 코드 끝 -->

                      </div>
                    </div>
                  </div>
                </div>
              
              <!-- 리뷰 & 별점 시스템 코드 끝 -->

              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
            </div>
          </div>
        </div>

    </div>

          
    
  </section>
</body>
</html>
