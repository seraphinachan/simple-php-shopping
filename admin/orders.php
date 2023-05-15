<?php
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

  <!-- General settings section -->
  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">USERS</h3>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                <i class="bi bi-check-all"></i> 전체 선택
              </a>
              <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                <i class="bi bi-trash"></i> 전체 삭제
              </a>
            </div>

            <div class="table-responsive-md text-center" style="height: 450px; overflow-y: scroll;">
              <table class="table table-hover border">
                <thread class="sticky-top">
                  <tr class="bg-dark text-light">
                    <th scope="col">#</th>
                    <th scope="col">주문 번호</th>
                    <th scope="col">회원 아이디</th>
                    <th scope="col">상품 번호</th>
                    <th scope="col">구입 수량</th>
                    <th scope="col">주문 일자</th>
                    <th scope="col">주문 상태</th>
                    <th scope="col">배송 상태</th>
                    <th scope="col">배송비</th>
                    <th scope="col">배송 완료 일시</th>
                    <th scope="col" class="rounded-end">Action</th>
                  </tr>
                </thread>
                <tbody class="users-data">
                  <?php
                  $query = "";
                  $result = mysqli_query($conn, $query);
                  $i = 1;

                  if(mysqli_num_rows($result) > 0)
                  {
                      foreach ($result as $rs) {
                          ?>
                          <tr class="align-middle">
                              <th><?= $i ?></th>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>
                                <a class="btn btn-warning shadow-none"></i>수정</a>
                                <form action="crud.php" method="POST" class="d-inline" onsubmit="return confirm('정말로 이 상품 정보를 삭제하시겠습니까?')">
                                  <button class="btn btn-danger shadow-none" value="<?= $rs['idx'];?>">삭제</button>
                                </form>
                              </td>
                          </tr>
                          <?php
                          $i++;
                      }
                  }
                  else
                  {
                      echo "<h5>등록된 주문이 없습니다.</h5>";
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
