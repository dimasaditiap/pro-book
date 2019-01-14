<?php

  // Mendapatkan rata-rata rating sebuah book
  function getAverageRating($book_id) {
    require(dirname(__FILE__)."/../server.php");

    $get_average_book_query = "
      SELECT COUNT(rating) AS total_rating, AVG(rating) AS avg_rating 
      FROM orders
      WHERE book_id = {$book_id} AND rating > 0 
      GROUP BY book_id
    ";
    return $link->query($get_average_book_query);
  }

?>