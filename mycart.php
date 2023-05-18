<?php
  session_start();
  require('dbconfig.php');
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

  <!-- 헤더 -->
  <?php
    include('header.php');
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center border rounded bg-light my-5">
        <h1>MY CART</h1>
      </div>

      <div class="col-lg-9">
        <table class="table align-middle">
          <thead class="text-center">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Item Image</th>
              <th scope="col">Item Name</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="text-center align-items-center">
            <?php
              $query = "SELECT * FROM cart WHERE user_id = ?";
              $stmt = $conn->prepare($query);
              $stmt->bind_param("s", $_SESSION['user_id']);
              $stmt->execute();
              $result = $stmt->get_result();
              $total = 0;
              $delivery_fee = 0;
              $i = 1;
              if (mysqli_num_rows($result) > 0) {
                while ($rs = $result->fetch_assoc()) {
                  $price = $rs['product_price'] * $rs['product_qty'];
                  $total += $price;
            ?>
                  <tr class="align-middle">
                    <th><?= $i ?></th>
                    <td><img src='./data/seller_upload/<?= $rs['product_image'] ?>' width='100'></td>
                    <td><?= $rs['product_name']; ?></td>
                    <td><?= $rs['product_price']; ?><input type='hidden' class='iprice' value='<?= $rs['product_price']; ?>'></td>
                    <td>
                      <form action='manage_cart.php' method='POST'>
                        <input class='text-center iquantity' name='Mod_Quantity' onchange='subTotal()' type='number' value='<?= $rs['product_qty']; ?>' min='1' max='99'>
                        <input type='hidden' name='Idx' value='<?= $rs['product_id']; ?>'>
                      </form>
                    </td>
                    <td class='itotal'></td>
                    <td>
<<<<<<< HEAD
                      <form action="manage_cart.php" method="POST">
                        <input type="hidden" name="delete_item" value="<?= $rs['product_id']; ?>">
                        <button class='btn btn-sm btn-outline-danger shadow-none' name="Remove_Items">삭제</button>
=======
                      <form action='manage_cart.php' method='POST'>
                        <button name='Remove_Items' class='btn btn-sm btn-outline-danger'>삭제</button>
                        <input type='hidden' name='Idx' value='<?= $rs['product_id']; ?>'>
>>>>>>> b9a434d176c7641416983952dbe6338572d0a051
                      </form>
                    </td>
                  </tr>
            <?php
                  $i++;
                }
              }
            ?>
          </tbody>
        </table>
      </div>


      <div class="col-lg-3">
        <div class="border bg-light rounded p-4">
          <div class="row">
            <label class="form-label" id="istotal" name="istotal"></label>
          </div>
          <div class="row">
            <label class="form-check-label" id="scost" name="scost"></label><?php echo $shipping_cost ?>
          </div>
          <hr>
          <div class="row">
            <label class="form-label" id="gtotal" name="gtotal"></label>
          </div>
          <div>
            <a class="btn btn-primary" href="payment.php">구매하기</a>
          </div>
        </div>
      </div>

<script>
  var gt = 0;
  var iprice = document.querySelectorAll('.iprice');
  var iquantity = document.querySelectorAll('.iquantity');
  var itotal = document.querySelectorAll('.itotal');
  var gtotal = document.getElementById('gtotal');
  var istotal = document.getElementById('istotal');
  var scost = document.getElementById('scost');

  function subTotal() {
    gt = 0;
    for (var i = 0; i < iprice.length; i++) {
      itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
      gt += (iprice[i].value) * (iquantity[i].value);
    }

    var shipping_cost = (gt == 0) ? 0 : ((gt < 30000) ? 3000 : 0);
    scost.innerText = (shipping_cost == 0) ? "무료배송" : "배송비 : " + shipping_cost + " 원";

    istotal.innerText = "상품금액 : " + gt + " 원";
    gtotal.innerText = "주문금액 : " + (gt + shipping_cost) + " 원";
  }

  subTotal();
</script>

  <?php
    include('footer.php');
  ?>
</body>
</html>
