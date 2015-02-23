<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

?>

<script src="js/search_writers.js"></script>

<form action="" method="post">
	<input type="text" id="search" oninput="loadContent();" placeholder="Sök">
	<!-- Show Results -->
    <ul id="results">
    </ul>
</form>

</body>
</html>