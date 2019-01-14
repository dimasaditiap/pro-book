<?php

  // Melakukan pendaftaran pengguna
  require(dirname(__FILE__)."/../server.php");
  require(dirname(__FILE__)."/../model/User.php");

  $input = $_POST;

  $username   = $input["username"];
  $name       = $input["name"];
  $email      = $input["email"];
  $password   = password_hash($input["password"], 1);
  $address    = $input["address"];
  $phone      = $input["phone"];
  
  $add_user_query = "
    insert into
      users   (username, name, email, password, address, phone, image)
      values  (\"{$username}\", \"{$name}\", \"{$email}\", \"{$password}\", \"{$address}\", \"{$phone}\", \"\")
  ";
  $status = $link->query($add_user_query);

  if ($status) {
    $get_user_query = "SELECT user_id FROM users WHERE username = '{$username}'";
    $user = $link->query($get_user_query);
  
    // Jika query gagal atau tidak ada username yang sesuai
    if (mysqli_num_rows($user) == 0) {
      header("Location: /login");
    };
  
    $userID;
    while($row = $user->fetch_assoc()) {
      $userID = $row["user_id"];
    }

    $access_token = random_bytes(8) . "-" . sha1($username . $userID) . "-" . (time() + (60 * 68 * 24 * 30));

    // Tambahkan token
    $insert_token_query = "UPDATE users SET token = '{$access_token}' WHERE user_id = {$userID}";
    $result = $link->query($insert_token_query);

    setcookie("id", $userID, time() + 3600, '/');
    setcookie("username", $username, time() + 3600, '/');
    setcookie("accesstoken", $access_token, time() + 3600, '/');
    redirect("../../browse");
  }
  else {
    redirect("../../register");
  }

  function redirect($url, $statusCode = 303)
  {
    header('Location: ' . $url, true, $statusCode);
    die();
  }
?>
