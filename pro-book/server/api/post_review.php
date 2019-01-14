<?php
    
    // Melakukan input review
    require(dirname(__FILE__)."/../server.php");

    $input = $_POST;
    
    $order_id = $input["button"];
    $rating = $input["star"];
    $comment = $input["comment"];

    $post_review_query = "UPDATE orders SET rating=".$rating." , comment=\"".$comment."\" WHERE order_id=".$order_id;
    $link->query($post_review_query);

    header("Location:/history");
    exit();
?>