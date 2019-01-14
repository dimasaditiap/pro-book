<?php 

  class Order {
    public $id;
    public $user_id;
    public $book_id;
    public $rating;
    public $comment;
    public $jumlah;
    public $time;

    function __construct($id, $user_id, $book_id, $rating, $comment, $jumlah, $time) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->book_id = $book_id;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->jumlah = $jumlah;
        $this->time = $time;
    }
  }

?>