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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
  </style>

</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <?php
    include('header.php');
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center border rounded bg-light my-3">
        <h1>PAYMENT</h1>
      </div>

      <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-10">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <h5 class="mb-3 fw-bold h-font"><i class="bi bi-bag-check"></i>상품정보</h5>
                
                <form action="pay_ok.php" method="POST" name="payform" id="pay_form">

                    <!-- 상품 정보 -->
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <table class="table align-middle">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Item Image</th>
                              <th scope="col">Item Name</th>                              
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                            </tr>
                          </thead>
                          <tbody class="text-center align-items-center">
                            <?php
                            if (isset($_SESSION['cart'])) 
                            {
                              foreach ($_SESSION['cart'] as $key => $value) {
                                $sr = $key + 1;
                                echo "
                                <tr>
                                  <td>$sr</td>
                                  <td><img src='../data/seller_upload/$value[Image]' width='100'></td>
                                  <td>$value[Item_Name]</td>
                                  <td><$value[Quantity]></td>
                                  <td>$value[Image]</td>
                                </tr>
                              ";
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <hr>

                    <!-- 배송지 정보 -->
                    <?php
                      $query = "SELECT * FROM user_info";
                      $rs = mysqli_query($conn, $query);
                    ?>
                    <h5 class="mb-3 text-left fw-bold h-font"><i class="bi bi-house"></i>배송지정보</h5>
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="">
                      </div>
                    </div>

                    <hr>                 

                    <!-- 무통장 입금 -->
                    <h5 class="mb-3 text-left fw-bold h-font"><i class="bi bi-wallet-fill"></i>결제수단</h5>


                    <div class="text-center mt-2 my-1">
                      <button type="submit" class="btn btn-outline-dark shadow-none mb-3">결제하기</button>
                    </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  

  

  <?php
    include('footer.php');
  ?>
</body>
</html>



