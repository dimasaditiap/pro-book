<?php require('../assets/php/checkauth.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <?php require('../assets/php/head.php'); ?>
    <title>Pro-Book | History</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/history/review.css">
</head>
<body>
  <?php require('../assets/php/header.php'); ?>

  <div class="review">
    <?php
      include "../server/api/get_book.php";

      $order_id = $_GET["order_id"];
      $book_id = $_GET["book_id"];
      $book = getBook($book_id)->fetch_assoc();

      echo '
        <div class="review__header">
            <div class="review__head-text">
                <div class="review__book-title orange">
                    <b>'.$book["title"].'</b>
                </div>
                <div class="review__book-author">
                    <b>'.$book["author"].'</b>
                </div>
            </div>
            <img src="'.$book["image"].'" class="review__book-img" align="buttom">
        </div>
        <form name="myform2" action="../server/api/post_review.php" onsubmit="return validateReviewForm()" method="post">
        <div class="review__subtitle">
            <b>Add Rating</b>
        </div>
        <!-- di sini bintangnya -->
            <div class="rating">
                <input id="star5" name="star" type="radio" value=5 class="radio-btn hide" />
                <label for="star5">☆</label>
                <input id="star4" name="star" type="radio" value=4 class="radio-btn hide" />
                <label for="star4">☆</label>
                <input id="star3" name="star" type="radio" value=3 class="radio-btn hide" />
                <label for="star3">☆</label>
                <input id="star2" name="star" type="radio" value=2 class="radio-btn hide" />
                <label for="star2">☆</label>
                <input id="star1" name="star" type="radio" value=1 class="radio-btn hide" />
                <label for="star1">☆</label>
                <div class="clear"></div>
            </div>
        <div class="review__subtitle editor">
            <b>Add Comment</b>
        </div>
        <textarea rows="5" cols="500" class="move-to-right" name="comment"></textarea>
        <div class="review__button">
            <a href="../history" class="review__back orange button_up">Back</a>
            <button class="review__submit blue-medium-background button_up" name="button" value='.$order_id.'>Submit</button>
        </div>
        </form>
      ';
    ?>
  </div>

    <script src="../assets/js/validation.js"></script>
    <script src="../history/index.js"></script>
</body>
</html>