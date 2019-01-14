<?php require('../assets/php/checkauth.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Pro-Book | Browse</title>
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/browse/search.css">
  <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/browse/search_result.css">
  
  <?php require('../assets/php/head.php'); ?>
</head>
<body ng-app='recommendbook' ng-controller='recommendcon'>
  <?php
    require('../assets/php/header.php'); 
    require('../server/api/get_average_rating.php');
  ?>

  <div class="search">
    <h1 class="search__title orange">Recommend Book</h1>
    <form class="search__form" id="search__form" ng-submit='search()'>
      <div class="search__form-row">
        <input 
          class="search__form-input" id="search__form-input" 
          type="text" name="search" placeholder="Input categories..."
          ng-model='searchvalue'
        > 
        <a href="/browse/index.php">Search Book</a>
      </div>
      <div class="search__form-row">
        <button class="search__form-button hover_lightBlue button_up">Search</button>
      </div>

      <div class="search-result" id="search-result">
          <div class="search-result__header">
            <h1 class="search-result__title orange">Search Result</h1>
            <h1 class="search-result__found">Found {{books.length}} result(s)</h1>
          </div>
          <div class="search-result__items" ng-repeat = "y in books">
          <!-- <h1 class="search-result__title orange">Search Result</h1> -->

            <div id="item-{{y['id']}}" class='search-result__item'>
              <div class='search-result__item-content'>
                <img src="{{y['imageUrl']}}" alt='item' class='search-result__item-img'>
                <div class='search-result__item-body'>
                  <h3 class='search-result__item-title orange'>{{y['title']}}</h3>
                  <h5 class='search-result__item-subtitle'>
                  {{y['authors'][0]}}
                  </h5>
                    <p class='search-result__item-desc'>
                    {{y['categories'][0]}}
                    </p>
                </div>
              </div>
              <button class='search-result__detail hover_lightBlue button_up'>
                <a href="/browse/book_details.php?book={{y['id']}}">Detail</a>
              </button>
            </div>
        </div>
      </div>
  <script src="../assets/js/browse/angular.min.js"></script>
  <script src="../assets/js/browse/recommend.js"></script>
</body>
</html>