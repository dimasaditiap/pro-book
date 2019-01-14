<?php
	//WSDL location
	$wsdl ="http://localhost:8888/ws/bookservice?wsdl";
	//create soap client
	$client = new SoapClient($wsdl, array('trace'=>1));
	//remote function param
	//title for SearchBook
	//categories for RecommendBook
	$title = "ninja";
	$id = "-56xtgEACAAJ";
	$categories = array("gore", "tps", "mature");
	$request_param = $id;
	//specific service call
	try
	{
	    $response = $client->detailBook($request_param);
		//$response = $client->recommendBook($request_param);
		//$response = $client->searchBook($request_param);
		header('Content-Type: application/json');
		echo $response;
	} 
	catch (Exception $e) 
	{ 
		echo "<h2>Exception Error!</h2>"; 
		echo $e->getMessage(); 
	}
?>
