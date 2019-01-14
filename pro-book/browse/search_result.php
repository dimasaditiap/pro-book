<?php require('../assets/php/checkauth.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <?php require('../assets/php/head.php'); ?>
    <title>Pro-Book | Search Result</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/browse/search_result.css">
</head>
<body>
  <?php 
    require('../assets/php/header.php'); 
    require('../server/api/get_books.php');
    require('../server/api/get_average_rating.php');

    $books = getBooks();
    $books_total = count($books);
  ?>

  <div class="search-result">
    <div class="search-result__header">
      <h1 class="search-result__title orange">Search Result</h1>
      <h1 class="search-result__found">Found <?php echo $books_total; ?> result(s)</h1>
    </div>
    <div class="search-result__items">
      <?php 
        for ($i=0; $i<5; $i++) {
          // $total_rating;
          // $average_rating;
          // $avg = getAverageRating($row['book_id']);
          // while ($rtg = $avg->fetch_assoc()) {
          //   $total_rating = $rtg['total_rating'];
          //   $average_rating = number_format($rtg['avg_rating'], 1);
          // } {$average_rating}/5.0 ({$total_rating} votes)
          echo "
            <div id='item-{$books[$i]->id}' class='search-result__item'>
              <div class='search-result__item-content'>
                <img src='{$books[$i]->imageUrl}' alt='item' class='search-result__item-img'>
                <div class='search-result__item-body'>
                  <h3 class='search-result__item-title orange'>{$books[$i]->title}</h3>
                  <h5 class='search-result__item-subtitle'>";
                  foreach ($books[$i]->authors as $author) {
                    echo "{$author}. ";
                  }
                  echo "</h5>
                  <p class='search-result__item-desc'>";
                  foreach ($books[$i]->categories as $category) {
                    echo "{$category}. ";
                  }
                  echo "</p>
                </div>
              </div>
              <button class='search-result__detail hover_lightBlue button_up'>
                <a href='/browse/book_details.php?book={$books[$i]->id}'>Detail</a>
              </button>
            </div>
          ";
        }
      ?>
    </div>
  </div>
  <script>
    var browse_tab = document.getElementById("browse_tab");
    browse_tab.className = "header_app_content orange-background hover_lightOrange";
  </script>
</body>
</html>
