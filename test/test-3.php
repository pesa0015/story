<?php

// require 'functions/connect.php';

require '../connect_localhost.php';

$error = 0;

function endsWith($haystack, $needle) {
    $length = strlen($needle);

    return (substr($haystack, -$length) === $needle);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$users = $_POST['users'];

	echo '<div style="color: silver; text-decoration: underline;">' . $users . '</div>';

	if (endsWith($users, "; ")) {
		$users = rtrim($users, "; ");
		echo '<div style="color: silver; text-decoration: underline;">' . $users . '</div>';
	}

	$users = explode("; ", $users);

	echo '<pre>';
	print_r($users);
	echo '</pre>';

	//$users = implode("', '", $users);

	//$sql = "SELECT user_id FROM `users` WHERE username IN ('$users');";

	//$users = implode("', '", $users);

	//$result = mysqli_query($conn, $sql);

	/*

	if ($result) {
		$user_id = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($user_id, $row['user_id']);
		}
	}

	// Check connection
	if (mysqli_errno($conn)) {
		echo "Failed: " . mysqli_error($conn);
	}
	
	//$row = mysqli_fetch_array($result);

	// echo $row['user_id'] . '<br />';
	// echo count($users) . '<br />';

	if (count($users) == count($user_id)) {

		//$users = array();

		//array_push($users, "Jokuram", "Soupyfloors", "Wedslate");

		*/
		
		$sql = "INSERT INTO `story_writers` (story_id, user_id, on_turn) 
		VALUES 
		(" . 1 . ", Jokuram, " . 0 . "), ";

		foreach ($users as $value) {
			$sql .= "(" . 1 . ", " . $value . ", " . 1 . "), ";
		}

		//$sql = "INSERT INTO `story_writers` (story_id, user_id) VALUES ";
		$sql = rtrim($sql, ", ");

		//echo count($users) . '<br />';
		//echo count($user_id) . '<br />';
		echo $sql;
		
		/*if (mysqli_query($conn, $sql)) {
			header("refresh: 0;");
		}

		else {
			echo mysqli_error($conn) . '<br />';
			echo $sql . '<br />';
		}*/

	}

	/*

	else {
		echo 'Failed!<br />';
		echo $sql;
	}

	*/

?>

<form action="" method="post">
	<textarea rows="2" cols="50" name="users">Soupyfloors; Wedslate; </textarea>
	<input type="submit" name="submit">
</form>