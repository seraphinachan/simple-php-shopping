<?php
session_start();
include('../dbconfig.php');
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

// 별점 평균 값을 구해서 products 테이블 rating 열에 업데이트하기
// 사용자가 입력한 데이터 가져오기
$rating = $_POST['rating'];
$product_id = $_POST['productid'];

// product_rating 테이블에서 평균 값을 계산하는 쿼리
$average_rating_query = "
  SELECT
    AVG(rating) AS average_rating
  FROM
    product_rating
  WHERE
    product_id = '$product_id'
";

$result = $conn->query($average_rating_query);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $average_rating = $row['average_rating'];

  // products 테이블 업데이트 쿼리
  $update_query = "
    UPDATE products
    SET rating = $average_rating
    WHERE idx = '$product_id'
  ";

  $conn->query($update_query);

} else {
  echo "평균 평점을 계산할 데이터가 없습니다.";
}

?>
