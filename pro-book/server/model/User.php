<?php 

  class User {
    public $id;
    public $username;
    public $name;
    public $email;
    // public $password;
    public $address;
    public $phone;
    public $image;

    function __construct($id, $username, $name, $email, $address , $phone, $image) {
      $this->id = $id;
      $this->username = $username;
      $this->name = $name;
      $this->email = $email;
      // $this->password = $password;
      $this->address = $address;
      $this->phone = $phone;
      $this->image = $image;

    }
  }

?>