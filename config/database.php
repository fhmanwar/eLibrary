<?php
class Database{

	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $db = "elibrary";
	public $conn;

	// public function __construct($host,$user,$pass,$db){
	// 	parent:: __construct($host,$user,$pass,$db);
	// 	$this->host = $host;
	// 	$this->$user = $user;
	// 	$this->$pass = $pass;
	// 	$this->db = $db;
	// }

	// get the database connection
	public function getConnection(){

			$this->conn = null;

			try{
					$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
			}catch(PDOException $exception){
					echo "Connection error: " . $exception->getMessage();
			}

			return $this->conn;
	}

}
?>
