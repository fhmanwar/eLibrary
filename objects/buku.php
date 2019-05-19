<?php
class Buku{

    // database connection and table name
    private $conn;
    private $table_name = "buku";

    // object properties
    public $id_buku;
    public $id_jenis;
    public $judul;
    public $penulis;
    public $subjek;
    public $serve_for;
    public $kode_buku;
    public $penerbit;
    public $tahun_terbit;
    public $status;
    public $ringkasan;
    public $jml_buku;
    public $image;
    public $timestamp;
    // public $price;

    public function __construct($db){
        $this->conn = $db;
    }

	function readAll(){

		$query = "SELECT
					id_buku, id_jenis, judul, penulis, subjek, serve_for, jml_buku, image 
				FROM
					" . $this->table_name . "
				ORDER BY
					id_buku ASC";
				// LIMIT
				// 	{$from_record_num}, {$records_per_page}
	
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	
		return $stmt;
	}

	// used for paging products
	public function countAll(){

		$query = "SELECT id_buku FROM " . $this->table_name . "";
  
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
  
		$num = $stmt->rowCount();
  
		return $num;
	}

    // create product
    function create(){
        //write query
        $query = "INSERT INTO " . $this->table_name . "
                SET 
                    id_jenis=:id_jenis, 
                    judul=:judul,
                    penulis=:penulis,
                    subjek=:subjek,
                    serve_for=:serve_for,
                    kode_buku=:kode_buku,
                    penerbit=:penerbit,
                    tahun_terbit=:tahun_terbit,
                    status=:status,
                    ringkasan=:ringkasan,
                    image=:image, 
                    jml_buku=:jml_buku,
                    created=:created
                ";
                    // price=:price, 

        $stmt = $this->conn->prepare($query);

        // posted values
        // $this->price=htmlspecialchars(strip_tags($this->price));
        $this->id_jenis=htmlspecialchars(strip_tags($this->id_jenis));
        $this->judul=htmlspecialchars(strip_tags($this->judul));
        $this->penulis=htmlspecialchars(strip_tags($this->penulis));
        $this->subjek=htmlspecialchars(strip_tags($this->subjek));
        $this->serve_for=htmlspecialchars(strip_tags($this->serve_for));
        $this->kode_buku=htmlspecialchars(strip_tags($this->kode_buku));
        $this->penerbit=htmlspecialchars(strip_tags($this->penerbit));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->ringkasan=htmlspecialchars(strip_tags($this->ringkasan));
        $this->jml_buku=htmlspecialchars(strip_tags($this->jml_buku));
        $this->iamge=htmlspecialchars(strip_tags($this->image));
        
        $this->tahun_terbit = date('Y');
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        // bind values
        // $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":id_jenis", $this->id_jenis);
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":subjek", $this->subjek);
        $stmt->bindParam(":serve_for", $this->serve_for);
        $stmt->bindParam(":kode_buku", $this->kode_buku);
        $stmt->bindParam(":penerbit", $this->penerbit);
        $stmt->bindParam(":tahun_terbit", $this->tahun_terbit);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":ringkasan", $this->ringkasan);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":jml_buku", $this->jml_buku);
        $stmt->bindParam(":created", $this->timestamp);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

  	function readOne(){

		$query = "SELECT
					id_buku, id_jenis, judul, penulis, subjek, serve_for, kode_buku, penerbit, tahun_terbit, status, ringkasan, jml_buku, image 
				FROM
					" . $this->table_name . "
				WHERE
                    id_buku = ?
				LIMIT
					0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id_buku);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id_jenis = $row['id_jenis'];
        $this->judul = $row['judul'];
        $this->penulis = $row['penulis'];
        $this->subjek = $row['subjek'];
        $this->serve_for = $row['serve_for'];
        $this->kode_buku = $row['kode_buku'];
        $this->penerbit = $row['penerbit'];
        $this->tahun_terbit = $row['tahun_terbit'];
        $this->status = $row['status'];
        $this->ringkasan = $row['ringkasan'];
        $this->jml_buku = $row['jml_buku'];
        $this->image = $row['image'];
  	}

    function update(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_jenis=:id_jenis, 
                    judul=:judul,
                    penulis=:penulis,
                    subjek=:subjek,
                    serve_for=:serve_for,
                    kode_buku=:jukode_bukudul,
                    penerbit=:penerbit,
                    tahun_terbit=:tahun_terbit,
                    status=:status,
                    ringkasan=:ringkasan,
                    image=:image, 
                    jml_buku=:jml_buku,
                    created=:created
                WHERE
                    id_buku = :id_buku";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->id_buku=htmlspecialchars(strip_tags($this->id_buku));
        $this->id_jenis=htmlspecialchars(strip_tags($this->id_jenis));
        $this->judul=htmlspecialchars(strip_tags($this->judul));
        $this->penulis=htmlspecialchars(strip_tags($this->penulis));
        $this->subjek=htmlspecialchars(strip_tags($this->subjek));
        $this->serve_for=htmlspecialchars(strip_tags($this->serve_for));
        $this->kode_buku=htmlspecialchars(strip_tags($this->kode_buku));
        $this->penerbit=htmlspecialchars(strip_tags($this->penerbit));
        $this->tahun_terbit=htmlspecialchars(strip_tags($this->tahun_terbit));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->ringkasan=htmlspecialchars(strip_tags($this->ringkasan));
        $this->jml_buku=htmlspecialchars(strip_tags($this->jml_buku));
        $this->image=htmlspecialchars(strip_tags($this->image));

        $this->timestamp = date('Y-m-d H:i:s');

        // bind parameters
        $stmt->bindParam(':id_buku', $this->id_buku);
        $stmt->bindParam(":id_jenis", $this->id_jenis);
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":subjek", $this->subjek);
        $stmt->bindParam(":serve_for", $this->serve_for);
        $stmt->bindParam(":kode_buku", $this->kode_buku);
        $stmt->bindParam(":penerbit", $this->penerbit);
        $stmt->bindParam(":tahun_terbit", $this->tahun_terbit);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":ringkasan", $this->ringkasan);
        $stmt->bindParam(":jml_buku", $this->jml_buku);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":created", $this->timestamp);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    // delete the product
    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE id_buku = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_buku);

        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // will upload image file to server
    function uploadPhoto(){
    
        $result_message="";
    
        // now, if image is not empty, try to upload the image
        if($this->image){
    
            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            // error message is empty
            $file_upload_error_messages="";
    
            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }
    
            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
    
            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
    
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (1024000)){
                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            }
    
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
    
            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }
    
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }
    
        }
    
        return $result_message;
    }
//   // read products by search term
//   public function search($search_term, $from_record_num, $records_per_page){

//       // select query
//       $query = "SELECT
//                   c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
//               FROM
//                   " . $this->table_name . " p
//                   LEFT JOIN
//                       categories c
//                           ON p.category_id = c.id
//               WHERE
//                   p.name LIKE ? OR p.description LIKE ?
//               ORDER BY
//                   p.name ASC
//               LIMIT
//                   ?, ?";

//       // prepare query statement
//       $stmt = $this->conn->prepare( $query );

//       // bind variable values
//       $search_term = "%{$search_term}%";
//       $stmt->bindParam(1, $search_term);
//       $stmt->bindParam(2, $search_term);
//       $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
//       $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

//       // execute query
//       $stmt->execute();

//       // return values from database
//       return $stmt;
//   }

//   public function countAll_BySearch($search_term){

//       // select query
//       $query = "SELECT
//                   COUNT(*) as total_rows
//               FROM
//                   " . $this->table_name . " p
//                   LEFT JOIN
//                       categories c
//                           ON p.category_id = c.id
//               WHERE
//                   p.name LIKE ?";

//       // prepare query statement
//       $stmt = $this->conn->prepare( $query );

//       // bind variable values
//       $search_term = "%{$search_term}%";
//       $stmt->bindParam(1, $search_term);

//       $stmt->execute();
//       $row = $stmt->fetch(PDO::FETCH_ASSOC);

//       return $row['total_rows'];
//   }


}
?>
