<?php

  function getBook($book_id) {
    $wsdl ="http://localhost:7000/ws/bookservice?wsdl";
    $client = new SoapClient($wsdl, array('trace'=>1));
    
    $categories = array("gore", "tps", "mature");
    $request_param = $book_id;
    //specific service call
    try {
      $response = $client->detailBook($request_param);
      // $response = $client->recommendBook($request_param);
      $book = json_decode($response);

      return $book;
    } 
    catch (Exception $e) { 
      echo "<h2>Exception Error!</h2>"; 
      echo $e->getMessage(); 
    }
  }

?>
