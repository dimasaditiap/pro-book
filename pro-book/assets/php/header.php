<header class="header_app">
  <div class="header_app_container">
    <div class="header_app_content bigger blue-light-background">
      <p class="header_app_content_appName"> 
        <span class="yellow-darker">Pro</span>-Book
      </p>
      <p class="header_app_content_userName">
        Hi, <?php echo $_COOKIE["username"] ?>
      </p>
    </div>
    <a href="/assets/php/logout.php" class="header_app_content orange-background hover_lightOrange">
      <img class="header_app_content_shutdown" src="../assets/img/shutdown.png" />
    </a>
  </div>
  <div class="header_app_container">
    <div class="header_app_content blue-medium-background hover_lightBlue" id="browse_tab">
      <a class="header_app_content_text"  href="/browse"><span class="bigger_bold">B</span>ROWSE</a>
    </div>
    <div class="header_app_content blue-medium-background hover_lightBlue" id="history_tab">
      <a class="header_app_content_text" href="/history"><span class="bigger_bold">H</span>ISTORY</a>
    </div>
    <div class="header_app_content blue-medium-background hover_lightBlue" id="profile_tab">
      <a class="header_app_content_text" href="/profile"><span class="bigger_bold">P</span>ROFILE</a>
    </div>
  </div>
</header>