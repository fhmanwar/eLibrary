<?php
/**
 *
 */
class User
{
  private $conn;
  private $db_tbl = 'tbl_user';

  public $id;
  public $id_anggota;
  public $user;
  public $pass;
  public $email;
  public $nama
  public $akses_level;

  function __construct($db)
  {
    $this->conn = $db;
  }

  function userExists(){ //cek jika user sudah ada
    $query = "SELECT id, nama, email, pass, akses_level
              FROM".$this->db_tbl."
              WHERE username = ?
              LIMIT 0,1";

    $stmt = $this->conn->prepare($query);
    $this->user = htmlspecialchars(strip_tags($this->user));
    $stmt->bindParam(1,$this->user);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num > 0){
      $row = $stmt->fetch(PDO::FETCH_ASSOC); //cek detail value

      //assign value to object properties
      $this->id = $row['id'];
      $this->id_anggota = $row['id_anggota'];
      $this->pass = $row['password'];
      $this->email = $row['email'];
      $this->nama = $row['nama'];
      $this->akses_level = $row['akses_level'];

      return true; //jika ada user
    }
    return false; //jika tdak ada user
  }

  
}

?>
