<?php
session_start();
include('../../dbconfig.php');

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
	// $average_rating = 0;
	// $total_review = 0;
	// $five_star_review = 0;
	// $four_star_review = 0;
	// $three_star_review = 0;
	// $two_star_review = 0;
	// $one_star_review = 0;
	// $total_user_rating = 0;
	// $review_content = array();
  //
	// $query = "
	// SELECT * FROM product_rating
	// ORDER BY idx DESC
	// ";
  //
	// $result = $connect->query($query);
  //
	// foreach($result as $row)
	// {
	// 	$review_content[] = array(
	// 		'user_id'		=>	$row["user_id"],
  //     'title'		=>	$row["title"],
  //     'content'		=>	$row["content"],
	// 		'rating'		=>	$row["rating"],
	// 		'reg_time'		=>	date('l jS, F Y h:i:s A', $row["reg_time"])
	// 	);
  //
	// 	if($row["rating"] == '5')
	// 	{
	// 		$five_star_review++;
	// 	}
  //
	// 	if($row["rating"] == '4')
	// 	{
	// 		$four_star_review++;
	// 	}
  //
	// 	if($row["rating"] == '3')
	// 	{
	// 		$three_star_review++;
	// 	}
  //
	// 	if($row["rating"] == '2')
	// 	{
	// 		$two_star_review++;
	// 	}
  //
	// 	if($row["rating"] == '1')
	// 	{
	// 		$one_star_review++;
	// 	}
  //
	// 	$total_review++;
  //
	// 	$total_user_rating = $total_user_rating + $row["rating"];
  //
	// }
  //
	// $average_rating = $total_user_rating / $total_review;
  //
	// $output = array(
	// 	'average_rating'	=>	number_format($average_rating, 1),
	// 	'total_review'		=>	$total_review,
	// 	'five_star_review'	=>	$five_star_review,
	// 	'four_star_review'	=>	$four_star_review,
	// 	'three_star_review'	=>	$three_star_review,
	// 	'two_star_review'	=>	$two_star_review,
	// 	'one_star_review'	=>	$one_star_review,
	// 	'review_data'		=>	$review_content
	// );
  //
  // echo json_encode($output);
// }


?>
