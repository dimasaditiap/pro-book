<?php
  // Melakukan pemesanan buku
  require(dirname(__FILE__)."/../server.php");
  
  $body = json_decode(file_get_contents('php://input'));
  $user_id = $body->user_id;
  $book_id = $body->book_id;
  $rating = $body->rating;
  $comment = $body->comment;
  $jumlah = $body->jumlah;
  
  $post_orders_query = "INSERT orders (user_id, book_id, rating, comment, jumlah) VALUES({$user_id}, {$book_id}, {$rating}, \"{$comment}\", {$jumlah})";
  $post_orders = $link->query($post_orders_query);

  if ($post_orders){
    $get_orders_query = "SELECT order_id FROM orders ORDER BY order_id DESC";
    $orders = $link->query($get_orders_query);
    $order_id;
    while($row = $orders->fetch_assoc()) {
      $order_id = $row["order_id"];
      break;
    }

    echo $order_id;
  } else {
    echo 0;
  }
?>
