<?php
/**
 *
 */
class User{
  // database connection and table name
  private $conn;
  private $table_name = "tbl_user";

  //object properties
  public $id;
  public $id_anggota;
  public $username;
  public $password;
  public $email;
  public $nama;
  public $akses_level;

  function __construct($db){
    $this->conn = $db;
  }
}

?>
