<?php
  // Mendapatkan riwayat pemesanan buku pengguna

  function getOrders($username) {
    require(dirname(__FILE__)."/../server.php");
    require(dirname(__FILE__)."/../model/BookOrder.php");

    $get_orders_query = "SELECT title, orders.book_id, author, users.username, books.image, order_id, rating, jumlah, time FROM (books inner join orders on books.book_id = orders.book_id) inner join users on users.user_id = orders.user_id where username = \"{$username}\"";
    $get_orders = $link->query($get_orders_query);

    $orders = array();

    while($row = $get_orders->fetch_assoc()) {
      array_push($orders, new BookOrder(
        $row["book_id"],
        $row["title"],
        $row["author"],
        $row["image"],
        $row["order_id"],
        $row["rating"],
        $row["jumlah"],
        $row["time"])
      );
    }

    return $orders;
  }

  // echo json_encode($orders);
?>
