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

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2">
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>
      </div>
      <div class="col-lg-9">
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR PRODUCTS</h2>
        <div class="container">
          <div class="row">

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

<script>
  const view = document.querySelectorAll("#view")
  view.forEach((box) => {
    box.addEventListener("click", () => {
      self.location.href = 'view.php?idx=' + box.dataset.idx
    })
  })
</script>