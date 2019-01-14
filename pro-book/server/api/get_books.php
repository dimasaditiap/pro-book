<?php
  // if (!isset($_REQUEST['search'])) {
  //   require '../browse/search_result.php';
  // } else {
  // Mendapatkan kumpulan buku saat dilakukan pencarian
  $wsdl ="http://localhost:7000/ws/bookservice?wsdl";
  $client = new SoapClient($wsdl, array('trace'=>1));
  
  $title = $_REQUEST["search"];
  $id = "-56xtgEACAAJ";
  $categories = array("gore", "tps", "mature");
  $request_param = $title;
  //specific service call
  try {
    // $response = $client->detailBook($request_param);
    // $response = $client->recommendBook($request_param);
    $response = $client->searchBook($request_param);
    $books = json_decode($response);

    echo ($response);
  } 
  catch (Exception $e) { 
    echo "<h2>Exception Error!</h2>"; 
    echo $e->getMessage(); 
    }
  // }
?>
