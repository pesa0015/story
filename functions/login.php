<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $check = login($_POST['user'], $_POST['password']);

  if (isset($check)) {
    if ($check == 'Fel användarnamn') {
      $check = $check[0];
    }
    if ($check == 'Fel lösenord') {
      $check = $check[0];
    }
    
  }

  /*

  if ($error == 1) {
    //Prepare errors for output
    foreach($errors as $val) {
      $output .= "<p class='ion-thumbsdown'> $val</p>";
      $error = "<div id='error'>" . @$output . "</div><br />";
    }
  }

  */

}

?>