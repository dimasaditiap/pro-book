<?php

  // Check apakah email tersedia atau tidak
  require(dirname(__FILE__)."/../server.php");
  require(dirname(__FILE__)."/../model/User.php");

  $json = file_get_contents('php://input');

  $input_email = json_decode($json)->email;

  $get_email_query = "SELECT * FROM users where email = \"{$input_email}\"";
  $get_email = $link->query($get_email_query);

  if (mysqli_num_rows($get_email) > 0) {
    echo 0;
  }
  else {
    echo 1;
  }
?>