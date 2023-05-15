<?php
session_start();
include('../dbconfig.php');

if(isset($_POST["action"]))
{
  //count(idx) as idx
  $select_cnt_sql = "
  SELECT
  count(idx) as total_cnt,
  avg(rating) as average_rating,
  (select count(idx) from product_rating where rating = '1') as one_star_review,
  (select count(idx) from product_rating where rating = '2') as two_star_review,
  (select count(idx) from product_rating where rating = '3') as three_star_review,
  (select count(idx) from product_rating where rating = '4') as four_star_review,
  (select count(idx) from product_rating where rating = '5') as five_star_review
  FROM
   product_rating
  WHERE product_id=?";

  $stmt = $conn->prepare($select_cnt_sql);
  $stmt->bind_param('s', $_POST['idx']);
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
