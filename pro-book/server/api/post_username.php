<?php

  // Check apakah username tersedia atau tidak
  require(dirname(__FILE__)."/../server.php");
  require(dirname(__FILE__)."/../model/User.php");

  $json = file_get_contents('php://input');

  $input_username = json_decode($json)->username;

  $get_username_query = "SELECT * FROM users where username = \"{$input_username}\"";
  $get_username = $link->query($get_username_query);

  // Jika tidak berjumlah nol maka username sudah terpakai (salah)
  if (mysqli_num_rows($get_username) > 0) {
    echo 0;
  }
  else {
    echo 1;
  }

?>
