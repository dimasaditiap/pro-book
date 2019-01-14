<?php
  // Mendapatkan kumpulan users saat dilakukan pencarian
  require(dirname(__FILE__)."/../server/server.php");
  require(dirname(__FILE__)."/../server/model/User.php");
  // setcookie("Id",1);
  $id = $_COOKIE["id"];
  $get_users_query = "SELECT * FROM users WHERE user_id = ".$id;
  $get_users = $link->query($get_users_query);
  $users = array();
  while($row = $get_users->fetch_assoc()) {
    array_push($users,new User(
      $row["user_id"], 
      $row["username"], 
      $row["name"], 
      $row["email"], 
      $row["address"],
      $row["phone"],
      $row["image"]
    ));
  }
  // $row = $get_users->fetch_assoc();
  // $users = new User(
  //   $row["user_id"], 
  //   $row["username"], 
  //   $row["name"], 
  //   $row["email"], 
  //   $row["address"],
  //   $row["phone"]
  // );
  // echo json_encode($users);
  // echo $row["password"] . " : " . password_hash($row["password"], 1);
?>