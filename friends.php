<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

$errorFriend = '';
$errorUser   = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$friend = $_POST['search'];

	$sql_search = sqlSelect("SELECT user_id, username FROM `users` WHERE username = '$friend'");

	if ($sql_search) {
		$sql_search2 = sqlSelect(
			'SELECT friend_request_id 
			FROM `friends` 
			WHERE user_id = "' . $_SESSION['user_id'] . '" 
			AND friend_user_id = "' . $sql_search[0]['user_id'] . '" 
			AND pending = "0";');
		$sql_search3 = sqlSelect(
			'SELECT friend_request_id 
			FROM `friends` WHERE user_id = "' . $sql_search[0]['user_id'] . '" 
			AND friend_user_id = "' . $_SESSION['user_id'] . '" 
			AND pending = "0";');
		$sql_search4 = sqlSelect(
			'SELECT friend_request_id 
			FROM `friends` 
			WHERE (
				user_id = "' . $_SESSION['user_id'] . '" 
				AND friend_user_id = "' . $sql_search[0]['user_id'] . '" 
				OR user_id = "' . $sql_search[0]['user_id'] . '" 
				AND friend_user_id = "' . $_SESSION['user_id'] . '"
				) 
			AND pending = "1";');

		if ($sql_search2) {	
			$errorFriend = '<div>Vänförfrågan redan skickad.</div>';
		}

		if ($sql_search3) {	
			$errorFriend = '<div>Du har redan en vänförfrågan från <a href="player_info.php?user_id=' . $sql_search[0]['user_id'] . '">' . $sql_search[0]['username'] . '</a></div>';
		}

		if ($sql_search4) {	
			$errorFriend = '<div>Du är redan vän med <a href="player_info.php?user_id=' . $sql_search[0]['user_id'] . '">' . $sql_search[0]['username'] . '</a></div>';
		}

		if (!$sql_search2 && !$sql_search3 && !$sql_search4) {
					
			sqlInsert("INSERT INTO `friends` (`friend_request_id`, `user_id`, `friend_user_id`, `pending`) VALUES (NULL, '" . $_SESSION['user_id'] . "', '" . $sql_search[0]['user_id'] . "', '0');");
			echo '<script>function test() { window.location.reload(); }</script>';
		}
	}

	else {
 		$errorUser = "Användaren finns inte.";
	}
}

?>

<script src="js/search__friends_input.js"></script>

	<h1>Mina vänner</h1>

	<?

	/*

	$sql_friends = 'SELECT users.username 
	FROM users 
	INNER JOIN 
		( 
			SELECT CASE 
			WHEN friends.user_id = ' . $_SESSION['user_id'] . ' THEN friends.friend_user_id 
			ELSE friends.user_id END person_id 
			FROM friends 
			WHERE (friends.user_id = ' . $_SESSION['user_id'] . ' 
			OR friends.friend_user_id = ' . $_SESSION['user_id'] . ') 
			AND pending = 1 
		)	friends ON users.user_id = friends.person_id;';

$sql_friends = sqlSelect('SELECT friends.friend_request_id, users.user_id, users.username FROM users INNER JOIN friends ON users.user_id = friends.user_id WHERE (friends.user_id = ' . $_SESSION['user_id'] . ' OR friends.friend_user_id = ' . $_SESSION['user_id'] . ') AND pending = 1');

*/

$sql_friends = sqlSelect('SELECT friends.friend_request_id, users.user_id, users.username 
	FROM users 
	INNER JOIN 
		( 
			SELECT friends.friend_request_id, 
			CASE WHEN friends.user_id = "' . $_SESSION['user_id'] . '" THEN friends.friend_user_id 
			ELSE friends.user_id END person_id 
			FROM friends 
			WHERE (friends.user_id = "' . $_SESSION['user_id'] . '" 
			OR friends.friend_user_id = "' . $_SESSION['user_id'] . '") 
			AND pending = 1 
		)	friends ON users.user_id = friends.person_id;');

foreach ($sql_friends as $friend) { 
	echo '<h3><a href="player_info.php?user_id=' . $friend['user_id'] . '">' . $friend['username'] . '</a>';
	echo '<a href="functions/delete_friend.php?friend_request_id=' . $friend['friend_request_id'] . '">Ta bort</a></h3>';
} 

?>

	<h1>Vänförfrågningar</h1>

<?

$sql_request = sqlSelect('SELECT friends.friend_request_id, users.user_id, users.username FROM users INNER JOIN friends ON users.user_id = friends.user_id WHERE friend_user_id = ' . $_SESSION['user_id'] . ' AND pending = 0;');

foreach ($sql_request as $friend_request) {
	echo '<h3><a href="player_info.php?user_id=' . $friend_request['user_id'] . '">' . $friend_request['username'] . '</a>';
	echo '<a href="functions/accept_friend.php?friend_request_id=' . $friend_request['friend_request_id'] . '">Acceptera</a><a href="functions/deny_friend.php?friend_request_id=' . $friend_request['friend_request_id'] . '">Neka</a></h3>';
} 

?>

	<h1>Avvaktande vänförfrågningar</h1>

	<?

$sql_friends = sqlSelect('SELECT friends.friend_request_id, users.user_id, users.username FROM users INNER JOIN friends ON users.user_id = friends.friend_user_id WHERE friends.user_id = ' . $_SESSION['user_id'] . ' AND pending = 0');

foreach ($sql_friends as $friend_request) {
	echo '<h3><a href="player_info.php?user_id=' . $friend_request['user_id'] . '">' . $friend_request['username'] . '</a>';
	echo '<a href="functions/delete_friend.php?friend_request_id=' . $friend_request['friend_request_id'] . '">Ångra</a></h3>';
}

?>

	<h1>Lägg till vän</h1>

	<form action="" method="post" class="navbar-form navbar-left">
	<?= $errorFriend; ?>
	<?= $errorUser; ?>
	<input type="text" id="search" name="search" autocomplete="off" oninput="loadContent();" placeholder="Sök" style="width: 250px; display: inline;">
	<input type="submit" name="addFriend" value="Ok" style="width: auto; display: inline;">
	<!-- Show Results -->
    <ul id="results" onclick="selectFriend(event);">
    </ul>
	</form>

	<script>
    function selectFriend(event) {
    	var selectedFriend = document.getElementById("search");
    	var li_result = document.getElementsByClassName("result");
        var target = event.target || event.srcElement;
        selectedFriend.value = event.target.innerHTML;
        for (var i=0;i<li_result.length;i+=1) {
  			li_result[i].style.display = "none";
		}
        return selectedFriend;
    }
    </script>

	

<?php require 'footer.php'; ?>