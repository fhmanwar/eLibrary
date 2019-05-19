<?php  
class Admin
{
    private $conn;
    private $table_name = "tbl_menu";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function rowCount()
    {
        // //Total menu count
        // $sql_menu = "SELECT COUNT(*) as num FROM tbl_menu";
        // $total_menu = mysqli_query($connect, $sql_menu);
        // $total_menu = mysqli_fetch_array($total_menu);
        // $total_menu = $total_menu['num'];
        // query to select all user records
        $query = "SELECT id_buku FROM " . $this->table_name . "";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // return row count
        return $num;
    }
    
}
