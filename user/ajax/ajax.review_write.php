<?php
session_start();
include('../../dbconfig.php');
// $userid    = $_POST['user_id'];
$userid    = $_SESSION['user_id'];
$productid = $_POST['productid'];
$rating    = $_POST['rating'];
$title = $_POST['title'];
$content = $_POST['content'];
// print_r($_POST);
// echo , var_dump();
// exit;
$query = "INSERT INTO product_rating (user_id, product_id, rating, title, content) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $userid, $productid, $rating, $title, $content);

if ($stmt->execute()) {
  // header('Location: items.php');
  // exit;
} else {
  die("오류가 발생하였습니다. 다시 시도해주세요." . $conn->error);
}


if(isset($_POST["action"]))
{
  //count(idx) as idx
  // echo "ssdsadsadas";
  $select_cnt_sql = "
  select
  count(idx) as total_cnt,
  avg(rating) as average_rating,
  (select count(idx) from product_rating where rating = '1') as one_star_review,
  (select count(idx) from product_rating where rating = '2') as two_star_review,
  (select count(idx) from product_rating where rating = '3') as three_star_review,
  (select count(idx) from product_rating where rating = '4') as four_star_review,
  (select count(idx) from product_rating where rating = '5') as five_star_review
  from
   product_rating
  ";

  // $query = "SELECT COUNT(*) cnt FROM products";
  $stmt = $conn->prepare($select_cnt_sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $output = array(
		'average_rating'	  =>	number_format($row['average_rating'], 1),
		'total_review'		  =>	$row['total_cnt'],
		'five_star_review'	=>	$row['five_star_review'],
		'four_star_review'	=>	$row['four_star_review'],
		'three_star_review'	=>	$row['three_star_review'],
		'two_star_review'	  =>	$row['two_star_review'],
		'one_star_review'	  =>	$row['one_star_review'],
		'review_data'		    =>	$review_content
	);

  echo json_encode($output);
  exit;
}

?>
