<?php
  // Melakukan perubahan pada profil pengguna
  require(dirname(__FILE__)."/../server/server.php");
  echo $_FILES["fileToUpload"]["name"];
  $user_id = $_COOKIE["id"];
  $name = $_POST["name"];
  $alamat = $_POST["address"];
  $phone = $_POST["phone"];
  $target_dir = "../assets/images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . basename("$user_id.".$imageFileType))) {
    $path_gambar = $target_dir . basename("$user_id.".$imageFileType);
  }
  if(isset($path_gambar)){
    $post_users_query = "UPDATE users SET name='$name' , address='$alamat' , phone='$phone' , image='$path_gambar' WHERE user_id=\"$user_id\"";
  }else{
    $post_users_query = "UPDATE users SET name='$name' , address='$alamat' , phone='$phone' WHERE user_id=\"$user_id\"";
  }
  $link->query($post_users_query);
  header("Location:/profile");
  exit();
?>
