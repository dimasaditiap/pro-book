<?php require('../assets/php/checkauth.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <?php require('../assets/php/head.php'); ?>
    <title>Pro-Book | History</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/history/history.css">
</head>
<body>
  <?php require('../assets/php/header.php'); ?>

  <div class="history">
    <div class="history__header orange">
      <b>History</b>
    </div>

    <?php
      include "../server/api/get_orders.php";
      
      $orders = getOrders($_COOKIE["username"]);
      foreach ($orders as $order) {
        if ($order->rating != 0) {
          $button = "";
          $pesan = "Anda sudah memberikan review";
        }
        else {
          $button = '
            <a href="../history/review.php?order_id='.$order->order_id.'&book_id='.$order->book_id.'">
              <button class="history__button blue-medium-background button_up">Review</button>
            </a>
          ';
          $pesan = "Belum direview";
        }

        echo '
          <div class="history__item">
            <img src="'.$order->image.'" class="history__book-img">
            <div class="history__book">
              <div class="history__book-title orange">
                <b>'.$order->title.'</b>
              </div>
              <div class="history__book-info">
                <p>Jumlah: '.$order->jumlah.'</p>
                <p>'.$pesan.'</p>
              </div>
            </div>
            <div class="history__order">
              <div class="history__order-info">
                <p><b>'.date("j F Y", strtotime($order->time)).'</b></p>
                <p><b>Nomor Order: #'.$order->order_id.'</b></p>
              </div>
              '.$button.'
            </div>
          </div>
        ';
      }
    ?>
  </div>

  <script src="../history/index.js"></script>
</body>
</html>