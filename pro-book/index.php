<?php 
  if (!isset($_COOKIE['id'])) { header("Location: /login"); } 
  else { header("Location: /browse"); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/index.css">
  <title>Pro-Book</title>
</head>
<body>
</body>
</html>