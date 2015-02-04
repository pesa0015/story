<?php

$error = "";
$not_sent = "";
$correct = "";

@$story = (int)$_GET['story'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		// collect all input and trim to remove leading and trailing whitespaces
		$words = mysqli_real_escape_string($conn, $_POST['words']);

		if (strlen($words) < 10) {
			$error = "Texten måste vara minst 10 tecken";
		}
		if (strlen($words) >= 10) {
		  	$sql = "INSERT INTO `row` (row_id, user_id, words, story_id, date) VALUES (NULL, " . $_SESSION['user_id'] . ", '$words', {$story}, now());";

			if ($conn->query($sql) === TRUE) {
			    $correct = "<script src='js/noty_row_inserted.js'></script>";
			    header("Refresh: 2; url=home.php");
			} 

			else {
				$not_sent = "Något gick fel. Försök igen.";
			    //echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
}

?>