<?php
  session_start();
  require('../dbconfig.php');
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
  <!-- Icon only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <style>
    /* 관리자 대시보드 */
    #dashboard-menu {
      position: fixed;
      height: 100%;
    }

    @media screen and (max-width: 992px) {
      #dashboard-menu {
        height: auto;
        width: 100%;
      }
      #main-content {
        margin-top: 60px;
      }
    }
  </style>

</head>

<body>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- 헤더 -->
  <?php require('header.php');
  ?>

  <!-- 상품 추가 모달 -->
  <div class="modal fade" id="add-items" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <form action="crud.php" id="regist_item" method="POST" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">상품 추가</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="상품 이름" required>
              </div>
              <div class="col-md-6 mb-3">
                <input type="number" class="form-control" id="price" name="price" placeholder="상품 가격" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <input type="number" class="form-control" id="qty" name="qty" placeholder="상품 수량" required>
              </div>
              <div class="col-md-6 mb-3">
                <input type="file" class="form-control" id="image" name="image" placeholder="상품 이미지" required>
              </div>
            </div>
            <!-- 썸머노트 -->
            <div id="summernote" name="description"></div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">취소</button>
            <button type="submit" class="btn btn-success shadow-none" name="add-items">등록</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  


  <!-- General settings section -->
  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">ITEMS</h3>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <button type="button" class="btn btn-dark rounded-pill shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-items">
                <i class="bi bi-plus-square"></i> 추가
              </button>
              <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                <i class="bi bi-check-all"></i> 전체 선택
              </a>
              <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                <i class="bi bi-trash"></i> 전체 삭제
              </a>
            </div>

            <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
              <table class="table table-hover text-center">
                  <thead class="bg-dark text-light sticky-top">
                      <tr class="bg-dark text-light">
                          <th scope="col" class="rounded-start">#</th>
                          <th scope="col">이미지</th>
                          <th scope="col">이름</th>
                          <th scope="col">가격</th>
                          <th scope="col">수량</th>
                          <th scope="col" class="rounded-end">Action</th>
                      </tr>
                  </thead>
                  <tbody class="items-data">
                    <?php
                    $query = "SELECT * FROM products";
                    $result = mysqli_query($conn, $query);
                    $i = 1;

                    if(mysqli_num_rows($result) > 0)
                    {
                        foreach ($result as $rs) {
                            ?>
                            <tr class="align-middle">
                                <th><?= $i ?></th>
                                <td><img src="../data/seller_upload/<?= $rs['image'] ?>" width="150px"></td>
                                <td><?= $rs['name'];?></td>
                                <td><?= $rs['price'];?></td>
                                <td><?= $rs['qty'];?></td>
                                <td>
                                  <button type="button" class="btn btn-warning shadow-none" data-bs-toggle="modal" data-bs-target="#update-items<?php echo $rs['idx']; ?>">
                                    <i class="bi bi-pencil-square"></i>수정
                                  </button>
                                  <form action="crud.php" method="POST" class="d-inline" onsubmit="return confirm('정말로 이 상품을 삭제하시겠습니까?')">
                                    <button class="btn btn-danger shadow-none" name="delete_item" value="<?= $rs['idx'];?>"><i class="bi bi-trash"></i>삭제</button>
                                  </form>
                                </td>
                            </tr> 
                            
                            상품 수정 모달
                            <div class="modal fade" id="update-items<?php echo $rs['idx']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <form action="update_items.php" id="update_items<?php echo $rs['idx']; ?>" method="POST" enctype="multipart/form-data">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">상품 수정</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6 mb-3">
                                          <input type="text" class="form-control" id="name" name="name" value="<?php echo $rs['name']; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                          <input type="number" class="form-control" id="price" name="price" value="<?php echo $rs['price']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6 mb-3">
                                          <input type="number" class="form-control" id="qty" name="qty" value="<?php echo $rs['qty']; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                          <input type="file" class="form-control" id="image" name="image" value="<?php echo $rs['image']; ?>" required>
                                        </div>
                                      </div>
                                      <!-- 썸머노트 -->
                                      <div id="summernote<?php echo $rs['idx']; ?>" name="description"></div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">취소</button>
                                      <button type="submit" class="btn btn-success shadow-none" name="update-items">수정</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <?php
                            $i++;
                        }
                    }
                    else
                    {
                        echo "<h5>등록된 상품이 없습니다.</h5>";
                    }
                    ?>
                </tbody>

              </table>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>


</body>
</html>

<script>
  $('#summernote').summernote({
    placeholder: '상품 상세 내용을 입력해주세요.',
    tabsize: 2,
    height: 200,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>

<script>
  $(document).ready(function() {
    <?php foreach($result as $rs) { ?>
      $('#summernote<?php echo $rs['idx']; ?>').summernote({
        placeholder: '상품 설명을 입력해주세요.',
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    <?php } ?>
  });
</script>

<!-- 상품 삭제 -->
<script>
  function confirm_rem($idx) {
    if(confirm("정말 상품을 삭제하시겠습니까?")){
      window.location.href="crud.php?rem="+idx;
    }
  }
 </script>
