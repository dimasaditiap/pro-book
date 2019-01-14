<?php
  require(dirname(__FILE__)."/config.php");

  // Sambungkan dengan server
  $link = new mysqli($dbhost, $dbuser, $dbpass);

  if ($link->connect_error) die('Connect Error (' . $link->connect_errno . ') '. $link->connect_error);

  // Buat database jika belum ada
  $create_db_query = 'CREATE DATABASE IF NOT EXISTS ' . $dbname;
  $create_db = mysqli_query($link, $create_db_query);

  if (!$create_db) die('Query Error: ' . mysqli_errno($link) . ' - ' . mysqli_error($link));

  // Sambungkan ke database
  $select_db = mysqli_select_db($link, $dbname);
  if (!$select_db) die('Query Error: ' . mysqli_errno($link) . ' - ' . mysqli_error($link));
?>