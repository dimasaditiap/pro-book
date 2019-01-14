<?php
  if (isset($_COOKIE['id'])) {
    header("Location: /browse");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pro-Book | Login</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="../login/index.css">
</head>
<body>
  <main class="login">
    <h1 class="login__title">LOGIN</h1>
    <form class="login__form"  method="POST" action="../server/api/post_login.php" onsubmit="return validateLoginForm()">
      <div class="login__field">
        <div class="login__input">
          <label for="username">Username</label>
          <input type="text" name="username">
        </div>
        <div class="login__input">
          <label for="password">Password</label>
          <input type="password" name="password">
        </div>
      </div>
      <p class="login__reminder"><a href="/register">Don't have an account?</a></p>
      <input class="login__submit" type="submit" name="submit" value="LOGIN" />
    </form>
  </main>

  <script src="../assets/js/validation.js"></script>
  <script src="../login/index.js"></script>
</body>
</html>