<?php
	include_once('includes/connect_database.php');
	include_once('functions.php');
?>
<div id="content" class="container col-md-12">
	<?php

		if(isset($_GET['id'])){
			$ID = $_GET['id'];
		}else{
			$ID = "";
		}

		// create array variable to store category data
		$category_data = array();

		$sql_query = "SELECT Category_ID, Category_name
				FROM tbl_category
				ORDER BY Category_ID ASC";

		$stmt_category = $connect->stmt_init();
		if($stmt_category->prepare($sql_query)) {
			// Execute query
			$stmt_category->execute();
			// store result
			$stmt_category->store_result();
			$stmt_category->bind_result($category_data['Category_ID'],
				$category_data['Category_name']
				);

		}

		$sql_query = "SELECT Menu_image FROM tbl_menu WHERE Menu_ID = ?";

		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $ID);
			// Execute query
			$stmt->execute();
			// store result
			$stmt->store_result();
			$stmt->bind_result($previous_menu_image);
			$stmt->fetch();
			$stmt->close();
		}


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


		if(isset($_POST['btnEdit'])){

			$menu_name = $_POST['menu_name'];
			$category_ID = $_POST['category_ID'];
			$price = $_POST['price'];
			$serve_for = $_POST['serve_for'];
			$description = $_POST['description'];
			$quantity = $_POST['quantity'];

			// get image info
			$menu_image = $_FILES['menu_image']['name'];
			$image_error = $_FILES['menu_image']['error'];
			$image_type = $_FILES['menu_image']['type'];

			// create array variable to handle error
			$error = array();

			if(empty($menu_name)){
				$error['menu_name'] = " <span class='label label-danger'>Required!</span>";
			}

			if(empty($category_ID)){
				$error['category_ID'] = " <span class='label label-danger'>Required!</span>";
			}

			if(empty($price)){
				$error['price'] = " <span class='label label-danger'>Required!</span>";
			}else if(!is_numeric($price)){
				$error['price'] = " <span class='label label-danger'>Price in number!</span>";
			}

			if(empty($quantity)){
				$error['quantity'] = " <span class='label label-danger'>Required!</span>";
			}else if(!is_numeric($quantity)){
				$error['quantity'] = " <span class='label label-danger'>Quantity in number!</span>";
			}

			if(empty($serve_for)){
				$error['serve_for'] = " <span class='label label-danger'>Not choosen</span>";
			}

			if(empty($description)){
				$error['description'] = " <span class='label label-danger'>Required!</span>";
			}

			// common image file extensions
			$allowedExts = array("gif", "jpeg", "jpg", "png");

			// get image file extension
			error_reporting(E_ERROR | E_PARSE);
			$extension = end(explode(".", $_FILES["menu_image"]["name"]));

			if(!empty($menu_image)){
				if(!(($image_type == "image/gif") ||
					($image_type == "image/jpeg") ||
					($image_type == "image/jpg") ||
					($image_type == "image/x-png") ||
					($image_type == "image/png") ||
					($image_type == "image/pjpeg")) &&
					!(in_array($extension, $allowedExts))){

					$error['menu_image'] = "*<span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
				}
			}


			if(!empty($menu_name) && !empty($category_ID) && !empty($price) && is_numeric($price) &&
				!empty($serve_for) && !empty($description) && empty($error['menu_image']) && !empty($quantity) && is_numeric($quantity)){

				if(!empty($menu_image)){

					// create random image file name
					$string = '0123456789';
					$file = preg_replace("/\s+/", "_", $_FILES['menu_image']['name']);
					$function = new functions;
					$menu_image = $function->get_random_string($string, 4)."-".date("Y-m-d").".".$extension;

					// delete previous image
					$delete = unlink("$previous_menu_image");

					// upload new image
					$upload = move_uploaded_file($_FILES['menu_image']['tmp_name'], 'upload/images/'.$menu_image);

					// updating all data
					$sql_query = "UPDATE tbl_menu
							SET Menu_name = ? , Category_ID = ?, Price = ?, Serve_for = ?, Menu_image = ?, Description = ?, Quantity = ?
							WHERE Menu_ID = ?";

					$upload_image = 'upload/images/'.$menu_image;
					$stmt = $connect->stmt_init();
					if($stmt->prepare($sql_query)) {
						// Bind your variables to replace the ?s
						$stmt->bind_param('ssssssss',
									$menu_name,
									$category_ID,
									$price,
									$serve_for,
									$upload_image,
									$description,
									$quantity,
									$ID);
						// Execute query
						$stmt->execute();
						// store result
						$update_result = $stmt->store_result();
						$stmt->close();
					}
				}else{

					// updating all data except image file
					$sql_query = "UPDATE tbl_menu
							SET Menu_name = ? , Category_ID = ?,
							Price = ?, Serve_for = ?, Description = ?, Quantity = ?
							WHERE Menu_ID = ?";

					$stmt = $connect->stmt_init();
					if($stmt->prepare($sql_query)) {
						// Bind your variables to replace the ?s
						$stmt->bind_param('sssssss',
									$menu_name,
									$category_ID,
									$price,
									$serve_for,
									$description,
									$quantity,
									$ID);
						// Execute query
						$stmt->execute();
						// store result
						$update_result = $stmt->store_result();
						$stmt->close();
					}
				}

				// check update result
				if($update_result){
					$error['update_data'] = " <span class='label label-primary'>Success update</span>";
				}else{
					$error['update_data'] = " <span class='label label-danger'>failed update</span>";
				}
			}

		}

		// create array variable to store previous data
		$data = array();

		$sql_query = "SELECT * FROM tbl_menu WHERE Menu_ID = ?";

		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $ID);
			// Execute query
			$stmt->execute();
			// store result
			$stmt->store_result();
			$stmt->bind_result($data['Menu_ID'],
					$data['Menu_name'],
					$data['Category_ID'],
					$data['Price'],
					$data['Serve_for'],
					$data['Menu_image'],
					$data['Description'],
					$data['Quantity']
					);
			$stmt->fetch();
			$stmt->close();
		}


	?>
	<div class="col-md-12">
	<h1>Edit Menu <?php echo isset($error['update_data']) ? $error['update_data'] : '';?></h1>
	<hr />
	</div>

  <div class="col-md-12">
  	<form method="post" enctype="multipart/form-data">
  		<div class="col-md-12">
  			<div class="form-group form-group-lg">
  				<label>Judul Buku</label><?php echo isset($error['judul_buku']) ? $error['judul_buku'] : '';?>
  				<input type="text" name="judul_buku" class="form-control" placeholder="Judul Buku" required>
  			</div>
  		</div>
  		<div class="col-md-4">
  			<div class="form-group form-group-lg">
  				<label>Penulis/Pengarang Buku</label><?php echo isset($error['penulis_buku']) ? $error['penulis_buku'] : '';?>
  				<input type="text" name="penulis_buku" class="form-control" placeholder="Penulis Buku" required>
  			</div>

  			<div class="form-group form-group-lg">
  				<label>Kode Buku</label><?php echo isset($error['kode_buku']) ? $error['kode_buku'] : '';?>
  				<input type="text" name="kode_buku" class="form-control" placeholder="Kode Buku" >
  			</div>

  			<div class="form-group form-group-lg">
  				<label>Jenis Buku</label><?php echo isset($error['id_jenis']) ? $error['id_jenis'] : '';?>
  				<select name="id_jenis" class="form-control">
  					<?php while($stmt_category->fetch()){ ?>
  						<option value="<?php echo $category_data['id_jenis']; ?>"><?php echo $category_data['nama_jenis']; ?></option>
  					<?php } ?>
  				</select>
  			</div>

  			<div class="form-group form-group-lg">
  				<label>Serve For</label><?php echo isset($error['serve_for']) ? $error['serve_for'] : '';?>
  				<select name="serve_for" class="form-control">
  					<option value="Available">Available</option>
  					<option value="Sold_Out">Sold Out</option>
  				</select>
  			</div>
  		</div>
  		<div class="col-md-4">

  			<div class="form-group form-group-lg">
  				<label>Subjek Buku</label><?php echo isset($error['subjek_buku']) ? $error['subjek_buku'] : '';?>
  				<input type="text" name="subjek_buku" class="form-control" placeholder="Subjek Buku" >
  			</div>

  			<div class="form-group form-group-lg">
  				<label>Penerbit Buku</label><?php echo isset($error['penerbit']) ? $error['penerbit'] : '';?>
  				<input type="text" name="penerbit" class="form-control" placeholder="Penerbit Buku">
  			</div>

  			<div class="form-group form-group-lg">
  				<label>Tahun Terbit</label><?php echo isset($error['tahun_terbit']) ? $error['tahun_terbit'] : '';?>
  				<input type="number" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit" >
  			</div>

  			<div class="form-group form-group-lg">
  				<label>Jumlah Buku</label><?php echo isset($error['jumlah_buku']) ? $error['jumlah_buku'] : '';?>
  				<input type="number" name="jumlah_buku" class="form-control" placeholder="Jumlah Buku">
  			</div>

  		</div>

  		<div class="col-md-4">
  			<div class="form-group form-group-lg">
  				<label>Uploud Cover Buku</label><?php echo isset($error['cover_buku']) ? $error['cover_buku'] : '';?>
  				<input type="file" name="cover_buku" id="menu_image" class="form-control" placeholder="Uploud Cover Buku">
  			</div>

  			<div class="form-group form-group-lg">
  				<label>status Buku </label><?php echo isset($error['status_buku']) ? $error['status_buku'] : '';?>
  				<select name="status_buku" class="form-control">
  					<option value="Publish">Publish</option>
  					<option value="Not_Publish">Not Publish</option>
  					<option value="Missing">Missing</option>
  				</select>
  			</div>

  			<div class="form-group form-group-lg">
  				<label>Description</label></label><?php echo isset($error['ringkasan']) ? $error['ringkasan'] : '';?>
  				<textarea name="ringkasan" class="form-control editor" rows="16" placeholder="Ringkasan"></textarea>
  			</div>

  		</div>

  		<div class="col-md-12 text-center">
  			<div class="form-group form-group-lg">
  				<input type="submit" name="Submit" class="btn btn-primary btn-lg" value="Save Data">
  				<input type="reset" class="btn btn-default btn-lg" value="Reset">
  			</div>
  		</div>

  	</form>
  	</div>
	<div class="separator"> </div>
</div>

<?php
	$stmt_category->close();
	include_once('includes/close_database.php'); ?>
