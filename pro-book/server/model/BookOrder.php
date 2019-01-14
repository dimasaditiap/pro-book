<?php 

  class BookOrder {
    public $book_id;
    public $title;
    public $author;
    public $image;
    public $order_id;
    public $rating;
    public $jumlah;
    public $time;

    function __construct($book_id, $title, $author, $image, $order_id, $rating, $jumlah, $time) {
        $this->book_id = $book_id;
        $this->title = $title;
        $this->author = $author;
        $this->image = $image;
        $this->order_id = $order_id;
        $this->rating = $rating;
        $this->jumlah = $jumlah;
        $this->time = $time;
    }
  }

?>