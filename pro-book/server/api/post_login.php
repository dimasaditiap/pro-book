<?php

  require(dirname(__FILE__)."/../server.php");

  $input_username = $_POST["username"];
  $input_password = $_POST["password"];

  $get_user_query = "SELECT user_id, username, password FROM users WHERE username = '{$input_username}'";
  $user = $link->query($get_user_query);

  // Jika query gagal atau tidak ada username yang sesuai
  if (!mysqli_num_rows($user) || !$user) {
    header("Location: /login");
  };

  $userID;
  $password;
  $username;
  while($row = $user->fetch_assoc()) {
    $userID = $row["user_id"];
    $password = $row["password"];
    $username = $row["username"];
  }

  if (password_verify($input_password, $password)) {
    $access_token = random_bytes(8) . "-" . sha1($username . $userID) . "-" . (time() + (60 * 60 * 24 * 30));

    $insert_token_query = "UPDATE users SET token = '{$access_token}' WHERE user_id = {$userID}";
    $result = $link->query($insert_token_query);

    setcookie("id", $userID, time() + 3600, '/');
    setcookie("username", $username, time() + 3600, '/');
    setcookie("accesstoken", $access_token, time() + 3600, '/');
    header("Location: /browse");
  } else {
    header("Location: /login");
  }

?>
