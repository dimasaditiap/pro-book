<?php
  require(dirname(__FILE__)."/server.php");

  $dump_sql = file_get_contents(dirname(__FILE__).'/bookstore.sql');
  
  if ($link->multi_query($dump_sql)) {
    echo "Successfully import dumpfile";
  } else {
    echo "Error import dumpfile";
  }

  $link->close();
?>