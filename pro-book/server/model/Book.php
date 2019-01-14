<?php 

  class Book {
    public $id;
    public $title;
    public $author;
    public $image;
    public $synopsis;

    function __construct($id, $title, $author, $image, $synopsis) {
      $this->id = $id;
      $this->title = $title;
      $this->author = $author;
      $this->image = $image;
      $this->synopsis = $synopsis;
    }
  }

?>