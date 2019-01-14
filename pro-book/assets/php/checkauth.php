<?php
  require(dirname(__FILE__)."/../../server/server.php");

  // Sambungkan dengan server
  $userId = $_COOKIE['id'];
  $accessToken = $_COOKIE["accesstoken"];

  // Jika cookie kosong, makan berarti belum login
  if (!isset($_COOKIE['id']) || !isset($_COOKIE['username']) || !isset($_COOKIE["accesstoken"])) {
    $link->query($remove_token_query);
    header("Location: /login");
  }

  $accesstoken = explode("-", $_COOKIE["accesstoken"]);

  // Jika expiry time accesstoken sudah habis, maka dipaksa logout
  if (time() > $accesstoken[2]) {
    header("Location: /assets/php/logout.php");
  }

  // Jika id atau username tidak sesuai dengan yang tersimpan di accesstoken maka dipaksa logout
  if (sha1($_COOKIE['username'] . $_COOKIE['id']) !== $accesstoken[1]) {
    header("Location: /assets/php/logout.php");
  }

  // Jika token yang tersimpan di cookie dan yg di db tidak sesuai
  $fetch_token_query = "SELECT * FROM users WHERE user_id = '{$userId}'";
  $result = $link->query($fetch_token_query);

  $token;
  while($row = $result->fetch_assoc()) {
    $token = $row["token"];
  }

  if ($token != $accessToken) {
    header("Location: /assets/php/logout.php");
  };
?>