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
  <title>Pro-Book | Register</title>
  <link rel="stylesheet" href="../register/index.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet">
</head>
<body>
  <main class="register">
    <h1 class="register__title">REGISTER</h1>
    <form 
      class="register__form" name="myform" 
      action="../server/api/post_register.php" 
      onsubmit="return validateRegisterForm()" method="post"
    >
      <div class="register__field">
        <div class="register__input">
          <label for="name">Name</label>
          <input type="text" name="name">
        </div>
        <div class="register__input">
          <label for="username">Username</label>
          <div class="register__check">
            <input type="text" name="username" id="username" onkeyup="validateUsernameAjax()">
            <div id="status"><img src="../assets/img/checklist-orange.png"/></div>
          </div>
        </div>
        <div class="register__input">
          <label for="email">Email</label>
          <div class="register__check">
            <input name="email" id="email" onkeyup="validateEmailAjax()">
            <div id="status2"><img src="../assets/img/checklist-orange.png"/></div>            
          </div>
        </div>
        <div class="register__input">
          <label for="password">Password</label>
          <input type="password" name="password">
        </div>
        <div class="register__input">
          <label for="password">Confirm Password</label>
          <input type="password" name="password2">
        </div>
        <div class="register__input">
          <label for="card_number">Card Number</label>
          <div class="register__check">
            <input type="number" name="card_number" id="card_number" onkeyup="validateCardNumberAjax()">
            <div id="status_card_number"><img src="../assets/img/checklist-orange.png"/></div>
          </div>
        </div>
        <div class="register__input">
          <label for="password">Address</label>
          <textarea name="address" resize rows="5"></textarea>
        </div>
        <div class="register__input">
          <label for="password">Phone Number</label>
          <input type="phone" name="phone">
        </div>
      </div>
      <p class="register__reminder"><a href="/login">Already have an account?</a></p>
      <button class="register__submit">REGISTER</button>
    </form>
  </main>
  <script src="../assets/js/validation.js"></script>
  <script src="../register/index.js"></script>
</body>
</html>
