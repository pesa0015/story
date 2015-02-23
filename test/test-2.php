<meta charset="UTF-8" />

<?php

/*

$sql = "INSERT INTO `story_writers` (story_id, user_id, on_turn) 
		VALUES 
		(" . 1 . ", Jokuram, " . 0 . "), ";

		foreach ($users as $value) {
			$sql .= "(" . 1 . ", " . $value . ", " . 1 . "), ";
		}

		//$sql = "INSERT INTO `story_writers` (story_id, user_id) VALUES ";
		$sql = rtrim($sql, ", ");

		*/

function endsWith($haystack, $needle) {
    $length = strlen($needle);

    return (substr($haystack, - $length) === $needle);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['story']) && !empty($_POST['users'])) {
	$users = $_POST['users'];

	if (endsWith($users, "; ")) {
		$users = rtrim($users, "; ");
	}

	if (endsWith($users, ";")) {
		$users = rtrim($users, ";");
	}

	$users = explode("; ", $users);

	$sql = "INSERT INTO `story_writers` (story_id, user_id, on_turn) 
		VALUES ";

	foreach ($_POST['story'] as $story) {
		foreach ($users as $user) {
			$sql .= "(" . $story . ", " . $user . ", " . 0 . "), ";
		}
	}

	//$sql = "INSERT INTO `story_writers` (story_id, user_id) VALUES ";
	$sql = rtrim($sql, ", ");
	echo $sql;

	/*

	echo '<pre>';
	print_r($users);
	echo '</pre>';

	echo '<pre>';
	print_r($_POST['story']);
	echo '</pre>';

	*/

	}
}

?>

<form action="" method="post">
	<textarea rows="2" name="users" placeholder="Bjud in författare..." value="" style="resize: vertical;">Soupyfloors; Wedslate</textarea><br />
	<input type="checkbox" id="checkbox" onClick="checkAll(this);">Markera alla<br />
	<input type="checkbox" class="checkboxes" name="story[]" value="1"><br />
	<input type="checkbox" class="checkboxes" name="story[]" value="2"><br />
	<input type="checkbox" class="checkboxes" name="story[]" value="3"><br /> 
	<input type="checkbox" class="checkboxes" name="story[]" value="4"><br />
	<input type="checkbox" class="checkboxes" name="story[]" value="5"><br />
	<input type="checkbox" class="checkboxes" name="story[]" value="6"><br />
	<input type="checkbox" class="checkboxes" name="story[]" value="7"><br />
	<input type="checkbox" class="checkboxes" name="story[]" value="8"><br />
	<input type="checkbox" class="checkboxes" name="story[]" value="9"><br />
	<input type="submit" name="submit" value="Skicka">
</form>

<script>
	function checkAll(source) {
  		checkboxes = document.getElementsByClassName('checkboxes');
  		for(var i = 0, n = checkboxes.length; i < n; i++) {
    		checkboxes[i].checked = source.checked;
  		}
	}
</script>