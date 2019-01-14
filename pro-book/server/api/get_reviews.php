<?php

  function getBookReviews($book_id) {
    require(dirname(__FILE__)."/../server.php");

    $get_reviews_query = "
      SELECT username, comment, rating, image
      FROM orders JOIN users ON orders.user_id = users.user_id 
      WHERE orders.book_id = {$book_id} 
    ";

    return $link->query($get_reviews_query);
  }

?>