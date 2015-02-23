<?php

session_start();
require 'sql_helpers2.php';
sqlInsert('UPDATE users_activity SET logout = now() WHERE user_id = ' . $_SESSION['user_id'] . ';');
session_destroy();
header('location: ../index.php');

?>