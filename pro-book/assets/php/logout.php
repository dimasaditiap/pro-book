<?php

  require(dirname(__FILE__)."/../../server/server.php");

  $userId = $_COOKIE['id'];
  $remove_token_query = "UPDATE users SET token = '' WHERE user_id = {$userId}";
  $link->query($remove_token_query);

  setcookie("id", NULL, NULL, '/');
  setcookie("username", NULL, NULL, '/');
  setcookie("accesstoken", NULL, NULL, '/');
  header("Location: /login");

?>