<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (isset($_POST['Add_To_Cart'])) {
    if (isset($_SESSION['cart'])) {
      $myitems = array_column($_SESSION['cart'], 'Idx');
      if (in_array($_POST['idx'], $myitems)) {
        echo
          "<script>
          var confirm = confirm('상품이 이미 장바구니에 있습니다. 추가하시겠습니까?');
          if(confirm) {
            window.location.href='mycart.php';
          }
          else
          {
            window.location.href='mycart.php';
          }
          
        </script>";
      } else {
        $count = count($_SESSION['cart']);
        $_SESSION['cart'][$count] = array(
          'Idx' => $_POST['idx'],
          'Image' => $_POST['image'],
          'Item_Name' => $_POST['name'],
          'Price' => $_POST['price'],
          'Quantity' => 1
        );
        echo
          "<script>
          alert('상품을 장바구니에 추가했습니다.');
          window.location.href='mycart.php';
        </script>";
      }
    } else {
      $_SESSION['cart'][0] = array(
        'Idx' => $_POST['idx'],
        'Image' => $_POST['image'],
        'Item_Name' => $_POST['name'],
        'Price' => $_POST['price'],
        'Quantity' => 1
      );
      echo
        "<script>
        alert('상품을 장바구니에 추가했습니다.');
        window.location.href='mycart.php';
      </script>";
    }
  }

  if (isset($_POST['Remove_Items'])) 
  {
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value['Idx'] == $_POST['Idx']) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        echo
          "<script>
          alert('상품이 장바구니에서 삭제되었습니다.');
          window.location.href='mycart.php';
        </script>";
      }

    }
  }
  if(isset($_POST['Mod_Quantity']))
  {
    foreach ($_SESSION['cart'] as $key => $value) 
    {
      if ($value['Idx'] == $_POST['Idx']) 
      {
        $_SESSION['cart'][$key]['Quantity'] = $_POST['Mod_Quantity'];
        print_r($_SESSION['cart']);
        // echo 
        // "<script>
        //   window.location.href='mycart.php';
        // </script>";
      }
    }
  }
}
?>