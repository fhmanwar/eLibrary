<?php
include_once('layout/head.php');
include_once('layout/header.php');
include_once('layout/nav.php');

include_once('../model/connect.php');
include_once('../helper/functions.php');
?>
<div id="content" class="container col-md-12">
	<?php
		// get currency symbol from setting table
		$sql_query = "SELECT Value
				FROM tbl_setting
				WHERE Variable = 'Currency'";


		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {
			// Execute query
			$stmt->execute();
			// store result
			$stmt->store_result();
			$stmt->bind_result($currency);
			$stmt->fetch();
			$stmt->close();
		}

		//$max_serve = 10;


		$sql_query = "SELECT id_jenis, nama_jenis
			FROM jenis
			ORDER BY id_jenis ASC";

		$stmt_category = $connect->stmt_init();
		if($stmt_category->prepare($sql_query)) {
			// Execute query
			$stmt_category->execute();
			// store result
			$stmt_category->store_result();
			$stmt_category->bind_result($category_data['id_jenis'],
				$category_data['nama_jenis']
				);
		}

		if(isset($_POST['submit'])){
			// $menu_name = $_POST['menu_name'];
			// $category_ID = $_POST['category_ID'];
			// $price = $_POST['price'];
			// $serve_for = $_POST['serve_for'];
			// $description = $_POST['description'];
			// $quantity = $_POST['quantity'];
			$id_jenis = $_POST['id_jenis'];
			$judul_buku = $_POST['judul_buku'];
			$penulis_buku = $_POST['penulis_buku'];
			$subjek_buku = $_POST['subjek_buku'];
			$serve_for = $_POST['Serve_for'];
			$kode_buku = $_POST['kode_buku'];
			$penerbit = $_POST['penerbit'];
			$tahun_terbit = $_POST['tahun_terbit'];
			$no_seri = $_POST['no_seri'];
			$status_buku = $_POST['status_buku'];
			$ringkasan = $_POST['ringkasan'];
			$jumlah_buku = $_POST['jumlah_buku'];
			$tanggal_entri = $_POST['tanggal_entri'];

			// get image info
			$cover_buku = $_FILES['cover_buku']['name'];
			$image_error = $_FILES['cover_buku']['error'];
			$image_type = $_FILES['cover_buku']['type'];


			// create array variable to handle error
			$error = array();

			if(empty($judul_buku)){
				$error['judul_buku'] = " <span class='label label-danger'>Required!</span>";
			}

			if(empty($id_jenis)){
				$error['id_jenis'] = " <span class='label label-danger'>Required!</span>";
			}
			if(empty($penulis_buku)){
				$error['penulis_buku'] = " <span class='label label-danger'>Required!</span>";
			}

			// if(empty($price)){
			// 	$error['price'] = " <span class='label label-danger'>Required!</span>";
			// }else if(!is_numeric($price)){
			// 	$error['price'] = " <span class='label label-danger'>Price in number!</span>";
			// }
			//
			// if(empty($quantity)){
			// 	$error['quantity'] = " <span class='label label-danger'>Required!</span>";
			// }else if(!is_numeric($quantity)){
			// 	$error['quantity'] = " <span class='label label-danger'>Quantity in number!</span>";
			// }

			if(empty($serve_for)){
				$error['serve_for'] = " <span class='label label-danger'>Not choosen</span>";
			}
			//
			// if(empty($description)){
			// 	$error['description'] = " <span class='label label-danger'>Required!</span>";
			// }

			// common image file extensions
			$allowedExts = array("gif", "jpeg", "jpg", "png");

			// get image file extension
			error_reporting(E_ERROR | E_PARSE);
			$extension = end(explode(".", $_FILES["cover_buku"]["name"]));

			if($image_error > 0){
				$error['cover_buku'] = " <span class='label label-danger'>Not uploaded!</span>";
			}else if(!(($image_type == "image/gif") ||
				($image_type == "image/jpeg") ||
				($image_type == "image/jpg") ||
				($image_type == "image/x-png") ||
				($image_type == "image/png") ||
				($image_type == "image/pjpeg")) &&
				!(in_array($extension, $allowedExts))){

				$error['cover_buku'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
			}

			// if(!empty($menu_name) && !empty($category_ID) && !empty($price) && is_numeric($price) &&
			// 	!empty($serve_for) && empty($error['menu_image']) && !empty($description) && !empty($quantity) && is_numeric($quantity)){
			if(!empty($judul_buku) && !empty($id_jenis) && !empty($penulis_buku) && !empty($serve_for) && empty($error['cover_buku'])){

				// create random image file name
				$string = '0123456789';
				$file = preg_replace("/\s+/", "_", $_FILES['cover_buku']['name']);
				$function = new functions;
				$menu_image = $function->get_random_string($string, 4)."-".date("Y-m-d").".".$extension;

				// upload new image
				$upload = move_uploaded_file($_FILES['cover_buku']['tmp_name'], 'aseets/upload/'.$cover_buku);

				// insert new data to menu table
				$sql_query = "INSERT INTO buku (id_jenis, judul_buku, penulis_buku, subjek_buku, Serve_for, kode_buku, penerbit, tahun_terbit, no_seri, status_buku, ringkasan, cover_buku, jumlah_buku, tanggal_entri)
						VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

				$upload_image = 'aseets/upload/'.$cover_buku;
				$stmt = $connect->stmt_init();
				if($stmt->prepare($sql_query)) {
					// Bind your variables to replace the ?s
					$stmt->bind_param('sssssss',
								$id_jenis,
								$judul_buku,
								$penulis_buku,
								$subjek_buku,
								$serve_for,
								$kode_buku,
								$penerbit,
								$tahun_terbit,
								$no_seri,
								$status_buku,
								$ringkasan,
								$upload_image,
								$jumlah_buku,
								$tanggal_entri
								);
					// Execute query
					$stmt->execute();
					// store result
					$result = $stmt->store_result();
					$stmt->close();
				}

				if($result){
					$error['add_menu'] = " <span class='label label-primary'>Success Added</span>";
				}else {
					$error['add_menu'] = " <span class='label label-danger'>Failed</span>";
				}
			}

			}
	?>
	<div class="col-md-12">
	<h1>Add Menu <?php echo isset($error['add_menu']) ? $error['add_menu'] : '';?></h1>
	<hr />
	</div>

	<div class="col-md-12">

	<form method="post" enctype="multipart/form-data">

	<div class="col-md-9">
		<div class="col-md-12">
		<label>Menu Name :</label><?php echo isset($error['judul_buku']) ? $error['judul_buku'] : '';?>
		<input type="text" class="form-control" name="judul_buku"/>
		</div>
	    <div class="col-md-3">
		    <br>
		    <label>Price (<?php echo $currency;?>) :</label><?php echo isset($error['price']) ? $error['price']:'';?>
				<input type="text" class="form-control" name="price"/>
				<br/>

				<label>Stock :</label><?php echo isset($error['quantity']) ? $error['quantity']:'';?>
				<input type="text" class="form-control" name="quantity"/>
				<br/>

			    <label>Status :</label><?php echo isset($error['serve_for']) ? $error['serve_for'] : '';?>
				<select name="serve_for" class="form-control">
					<option>Available</option>
					<option>Sold Out</option>
				</select>
				<br/>

			    <label>Category :</label><?php echo isset($error['category_ID']) ? $error['category_ID'] : '';?>
				<select name="category_ID" class="form-control">
					<?php while($stmt_category->fetch()){ ?>
						<option value="<?php echo $category_data['Category_ID']; ?>"><?php echo $category_data['Category_name']; ?></option>
					<?php } ?>
				</select>

				<br/>
				<label>Image :</label><?php echo isset($error['menu_image']) ? $error['menu_image'] : '';?>
				<input type="file" name="menu_image" id="menu_image"/>
			</div>

		<div class="col-md-9">
		<br>
		<label>Description :</label><?php echo isset($error['description']) ? $error['description'] : '';?>
		<textarea name="description" id="description" class="form-control editor" rows="16"></textarea>
		<!-- <script type="text/javascript" src="css/js/ckeditor/ckeditor.js"></script>
		<script type="text/javascript">
        CKEDITOR.replace( 'description' );
    </script> -->
		</div>
	</div>

	<br/>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">Add</div>
				<div class="panel-body">
					<input type="submit" class="btn-primary btn" value="Add" name="submit" />&nbsp;
					<input type="reset" class="btn-danger btn" value="Clear"/>
				</div>
		</div>
	</div>
	</form>
	</div>
	<div class="separator"> </div>
</div>


<?php
	$stmt_category->close();
  include_once('../model/close_database.php');
	include_once('layout/footer.php');
?>
