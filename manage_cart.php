<?php
session_start();
include('./dbconfig.php');

if (isset($_POST['Add_To_Cart']))
{
  if (!isset($_SESSION['user_id']))
  {
    // Redirect user to login page or display error message
    echo "<script>
        alert('로그인이 필요합니다.');
        window.location.href='login.php';
      </script>";
  }
  else
  {
    if (isset($_SESSION['cart']))
    {
      $myitems = array_column($_SESSION['cart'], 'Idx');
      if (in_array($_POST['idx'], $myitems))
      {
        echo "<script>
          alert('상품이 이미 장바구니에 있습니다.');
          window.location.href='items.php';
        </script>";
      }
      else
      {
        $product_id = $_POST['idx'];
        $product_image = $_POST['image'];
        $product_name = $_POST['name'];
        $product_price = $_POST['price'];
        $product_qty = 1;

        $insert_query = "INSERT INTO cart (user_id, product_id, product_name, product_image, product_qty, product_price) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssssii", $_SESSION['user_id'], $product_id, $product_name, $product_image, $product_qty, $product_price);
        $stmt->execute();

        echo "<script>
            alert('상품을 장바구니에 추가했습니다.');
            window.location.href='mycart.php';
          </script>";
      }
    }
    else
    {
      echo "카트가 없습니다.";
    }
  }
}

if (isset($_POST['Remove_Items']))
{
  foreach ($_SESSION['cart'] as $key => $value)
  {
    if ($value['Idx'] == $_POST['Idx'])
    {
      unset($_SESSION['cart'][$key]);
      $_SESSION['cart'] = array_values($_SESSION['cart']);
      echo "<script>
        alert('상품이 장바구니에서 삭제되었습니다.');
        window.location.href='mycart.php';
      </script>";
    }
  }
}
?>


/*
session_start();
include('./dbconfig.php');

if (isset($_POST['Add_To_Cart']))
{
  if (isset($_SESSION['cart']))
  {
    $myitems = array_column($_SESSION['cart'], 'Idx');
    if (in_array($_POST['idx'], $myitems))
    {
      echo "<script>
        alert('상품이 이미 장바구니에 있습니다.');
        window.location.href='items.php';
      </script>";
    }
    else
    {
      if (isset($_SESSION['user_id'])) {
        $count = count($_SESSION['cart']);
        $_SESSION['cart'][$count] = array(
          'Idx' => $_POST['idx'],
          'Image' => $_POST['image'],
          'Item_Name' => $_POST['name'],
          'Price' => $_POST['price'],
          'Quantity' => 1
        );
      }

      $count = count($_SESSION['cart']);
      $_SESSION['cart'][$count] = array(
        'Idx' => $_POST['idx'],
        'Image' => $_POST['image'],
        'Item_Name' => $_POST['name'],
        'Price' => $_POST['price'],
        'Quantity' => 1
      );
      echo "<script>
        alert('상품을 장바구니에 추가했습니다.');
        window.location.href='mycart.php';
      </script>";
    }
  }
  else
  {
    $_SESSION['cart'][0] = array(
      'Idx' => $_POST['idx'],
      'Image' => $_POST['image'],
      'Item_Name' => $_POST['name'],
      'Price' => $_POST['price'],
      'Quantity' => 1
    );
    echo "<script>
      alert('상품을 장바구니에 추가했습니다.');
      window.location.href='mycart.php';
    </script>";
  }
}

if (isset($_POST['Remove_Items']))
{
  foreach ($_SESSION['cart'] as $key => $value)
  {
    if ($value['Idx'] == $_POST['Idx'])
    {
      unset($_SESSION['cart'][$key]);
      $_SESSION['cart'] = array_values($_SESSION['cart']);
      echo "<script>
        alert('상품이 장바구니에서 삭제되었습니다.');
        window.location.href='mycart.php';
      </script>";
    }
  }
}
*/
