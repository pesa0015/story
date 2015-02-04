<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $user = login($_POST['user'], $_POST['password']);
    
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