<?php
session_start();

include('../dbconfig.php');

$userid = $_SESSION['user_id'];
$productid = $_POST['productid'];
$rating = $_POST['rating'];
$title = $_POST['title'];
$content = $_POST['content'];

$query = "INSERT INTO product_rating (user_id, product_id, rating, title, content) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $userid, $productid, $rating, $title, $content);

if ($stmt->execute()) {
  header('Location: items.php');
  exit;
} else {
  die("오류가 발생하였습니다. 다시 시도해주세요." . $conn->error);
}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
	SELECT * FROM product_rating
	ORDER BY idx DESC
	";

	$result = $connect->query($query);

	foreach($result as $row)
	{
		$review_content[] = array(
			'user_id'		=>	$row["user_id"],
      'title'		=>	$row["title"],
      'content'		=>	$row["content"],
			'rating'		=>	$row["rating"],
			'reg_time'		=>	date('l jS, F Y h:i:s A', $row["reg_time"])
		);

		if($row["rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

  echo json_encode($output);
}
?>
