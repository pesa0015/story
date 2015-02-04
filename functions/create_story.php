<?php

$error = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$subject = sqlEscape($_POST['subject']);
		$new_subject = sqlEscape($_POST['new_subject']);
		$opening_row = sqlEscape($_POST['opening_row']);
		$num_of_rows = sqlEscape($_POST['num_of_rows']);
		$num_of_writers = sqlEscape($_POST['num_of_writers']);
		$users = explode("; ", sqlEscape($_POST['users']));

		if ($subject) {
			$subject = $subject;
		}

		if ($new_subject) {
			$subject = $new_subject;
		}

		if (strlen($opening_row) < 10) {
			echo "Texten måste vara minst 10 tecken.<br />";
		}

		if (strlen($num_of_rows) > 0) {
			if (!is_numeric($num_of_rows)) {
				echo "Måste vara numeriskt.<br />";
			}
		}

		if (strlen($num_of_writers) > 0) {
			if (!is_numeric($num_of_writers)) {
				echo "Måste vara numeriskt.<br />";
			}
		}

		if (count($users) < 2) {
			echo "Du måste bjuda in minst två författare eftersom en story ska vara skriven av minst tre personer.<br />";
		}

		if (count($users) >= 2 && strlen($opening_row) >= 10) {
			$tables = sqlSelect("SELECT story_id FROM `story` ORDER BY story_id DESC LIMIT 1;");

			if ($tables) {
				foreach ($tables as $row) {
					$i = $row['story_id']+1;
				}
			}

			$users = implode("', '", $users);

			$sql = sqlSelect("SELECT user_id FROM `users` WHERE username IN ('$users');");

			$users = explode("', '", $users);

			if ($sql) {
				$user_id = array();

				foreach ($sql as $row) {
					array_push($user_id, $row['user_id']);
				}
			}	

			if (count($users) == count($user_id)) {
				$error = 0;
				$sql_admin = '';
				$sql_flexible = '';

				if (isset($_POST['admin_yes']) || isset($_POST['admin_no'])) {
				    if (isset($_POST['admin_yes']) && isset($_POST['admin_no'])) {
				        $error = 1;
				    }
				    else {
				        if (isset($_POST['admin_yes'])) {
				            $sql_admin = $_SESSION['user_id'];
				        }
				        if (isset($_POST['admin_no'])) {
				            $sql_admin = null;
				        }
				    }
				}

				$user_id_original = $user_id;

				if (isset($_POST['flexible_yes']) || isset($_POST['flexible_no'])) {
				    if (isset($_POST['flexible_yes']) && isset($_POST['flexible_no'])) {
				        $error = 1;
				    }
				    else {
				        if (isset($_POST['flexible_yes'])) {
				            $sql_flexible = $_POST['flexible_yes'];

							$sql = "INSERT INTO `story_writers` (story_id, user_id, on_turn) 
							VALUES 
							(" . $i . ", " . $_SESSION['user_id'] . ", " . 0 . "), ";

							foreach ($user_id_original as $value) {
								$sql .= "(" . $i . ", " . $value . ", " . 1 . "), ";
							}
				        }
				        if (isset($_POST['flexible_no'])) {
				            $sql_flexible = $_POST['flexible_no'];

				            $first_user_id = array_shift($user_id);

							$sql = "INSERT INTO `story_writers` (story_id, user_id, on_turn) 
							VALUES 
							(" . $i . ", " . $_SESSION['user_id'] . ", " . 0 . "), (" . $i . ", " . $first_user_id . ", " . 1 . "), ";

							foreach ($user_id as $value) {
								$sql .= "(" . $i . ", " . $value . ", " . 0 . "), ";
							}
				        }
				    }
				}

				$sql = rtrim($sql, ", ");

				if ($error == 1) {
				    echo 'Error';
				}

				else {

						if (strlen($num_of_rows) > 0 && strlen($num_of_writers) > 0) {
							$sql_create1 = sqlInsert("INSERT INTO `story` (story_id, max_rows, total_rows, max_writers, admin, flexible, thumbs_up, thumbs_down) VALUES (NULL, $num_of_rows, 1, $num_of_writers, $sql_admin, '$sql_flexible', 0, 0);");
							$sql_create2 = sqlInsert("INSERT INTO `row` (row_id, user_id, words, story_id, date) VALUES (NULL, " . $_SESSION['user_id'] . ", '$opening_row', " . $i . ", now());");
							$sql = sqlInsert($sql);
						}

						else if (strlen($num_of_rows) > 0 && strlen($num_of_writers) == 0) {
							$sql_create1 = sqlInsert("INSERT INTO `story` (story_id, max_rows, total_rows, max_writers, admin, flexible, thumbs_up, thumbs_down) VALUES (NULL, $num_of_rows, 1, NULL, $sql_admin, '$sql_flexible', 0, 0);");
							$sql_create2 = sqlInsert("INSERT INTO `row` (row_id, user_id, words, story_id, date) VALUES (NULL, " . $_SESSION['user_id'] . ", '$opening_row', " . $i . ", now());");
							$sql = sqlInsert($sql);
						}

						else if (strlen($num_of_rows) == 0 && strlen($num_of_writers) > 0) {
							$sql_create1 = sqlInsert("INSERT INTO `story` (story_id, max_rows, total_rows, max_writers, admin, flexible, thumbs_up, thumbs_down) VALUES (NULL, 30, 1, $num_of_writers, $sql_admin, '$sql_flexible', 0, 0);");
							$sql_create2 = sqlInsert("INSERT INTO `row` (row_id, user_id, words, story_id, date) VALUES (NULL, " . $_SESSION['user_id'] . ", '$opening_row', " . $i . ", now());");
							$sql = sqlInsert($sql);
						}

						else if (strlen($num_of_rows) == 0 && strlen($num_of_writers) == 0) {
							$sql_create1 = sqlInsert("INSERT INTO `story` (story_id, max_rows, total_rows, max_writers, admin, flexible, thumbs_up, thumbs_down) VALUES (NULL, 30, 1, NULL, $sql_admin, '$sql_flexible', 0, 0);");
							$sql_create2 = sqlInsert("INSERT INTO `row` (row_id, user_id, words, story_id, date) VALUES (NULL, " . $_SESSION['user_id'] . ", '$opening_row', " . $i . ", now());");
							$sql = sqlInsert($sql);
						}

						if ($error == 1) {
							echo 'Något gick fel. Försök igen.';
						}

						if ($error == 0) {
							echo '<script src="js/noty_story_created.js"></script>';
						}
					}
				}
			}
		}

?>