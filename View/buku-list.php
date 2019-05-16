<?php
	include_once('layout/head.php');
	include_once('layout/header.php');
	include_once('layout/nav.php');

	include_once('../model/connect.php');
	include_once('../helper/functions.php');
?>

<div id="content" class="container col-md-12">
<?php
	// create object of functions class
	$function = new functions;

	// create array variable to store data from database
	$data = array();

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

	if(isset($_GET['keyword'])){
		// check value of keyword variable
		$keyword = $function->sanitize($_GET['keyword']);
		$bind_keyword = "%".$keyword."%";
	}else{
		$keyword = "";
		$bind_keyword = $keyword;
	}



	// get all data from menu table and category table
	if(empty($keyword)){
		// $sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
		// 		FROM tbl_menu m, tbl_category c
		// 		WHERE m.Category_ID = c.Category_ID
		// 		ORDER BY m.Menu_ID DESC";
		$sql_query = "SELECT id_buku, judul_buku, nama_jenis, penulis_buku, subjek_buku, Serve_for, kode_buku, penerbit, tahun_terbit, no_seri, status_buku, ringkasan, cover_buku, jumlah_buku, tanggal_entri
				FROM buku b, jenis j
				WHERE b.id_jenis = j.id_jenis
				ORDER BY b.id_buku DESC";
	}else{
		// $sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
		// 		FROM tbl_menu m, tbl_category c
		// 		WHERE m.Category_ID = c.Category_ID AND Menu_name LIKE ?
		// 		ORDER BY m.Menu_ID DESC";
		$sql_query = "SELECT id_buku, judul_buku, nama_jenis, penulis_buku, subjek_buku, Serve_for, kode_buku, penerbit, tahun_terbit, no_seri, status_buku, ringkasan, cover_buku, jumlah_buku, tanggal_entri
				FROM buku b, jenis j
				WHERE b.id_jenis = j.id_jenis AND Menu_name LIKE ?
				ORDER BY b.id_buku DESC";
	}

	$stmt = $connect->stmt_init();
	if($stmt->prepare($sql_query)) {
		// Bind your variables to replace the ?s
		if(!empty($keyword)){
			$stmt->bind_param('s', $bind_keyword);
		}
		// Execute query
		$stmt->execute();
		// store result
		$stmt->store_result();
		// $stmt->bind_result($data['Menu_ID'],
		// 		$data['Menu_name'],
		// 		$data['Category_name'],
		// 		$data['Price'],
		// 		$data['Serve_for'],
		// 		$data['Menu_image'],
		// 		$data['Quantity']
		// 		);
		$stmt->bind_result($data['id_buku'],
				$data['judul_buku'],
				$data['nama_jenis'],
				$data['penulis_buku'],
				$data['subjek_buku'],
				$data['Serve_for'],
				$data['kode_buku'],
				$data['penerbit'],
				$data['tahun_terbit'],
				$data['no_seri'],
				$data['status_buku'],
				$data['ringkasan'],
				$data['cover_buku'],
				$data['jumlah_buku'],
				$data['tanggal_entri']
				);

		// get total records
		$total_records = $stmt->num_rows;
	}

	// // check page parameter
	// if(isset($_GET['page'])){
	// 	$page = $_GET['page'];
	// }else{
	// 	$page = 1;
	// }
	//
	// // number of data that will be display per page
	// $offset = 10;
	//
	// //lets calculate the LIMIT for SQL, and save it $from
	// if ($page){
	// 	$from 	= ($page * $offset) - $offset;
	// }else{
	// 	//if nothing was given in page request, lets load the first page
	// 	$from = 0;
	// }
	//
	// // get all data from reservation table
	// if(empty($keyword)){
	// 	$sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
	// 			FROM tbl_menu m, tbl_category c
	// 			WHERE m.Category_ID = c.Category_ID
	// 			ORDER BY m.Menu_ID DESC LIMIT ?, ?";
	// }else{
	// 	$sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
	// 			FROM tbl_menu m, tbl_category c
	// 			WHERE m.Category_ID = c.Category_ID AND Menu_name LIKE ?
	// 			ORDER BY m.Menu_ID DESC LIMIT ?, ?";
	// }
	//
	// $stmt_paging = $connect->stmt_init();
	// if($stmt_paging ->prepare($sql_query)) {
	// 	// Bind your variables to replace the ?s
	// 	if(empty($keyword)){
	// 		$stmt_paging ->bind_param('ss', $from, $offset);
	// 	}else{
	// 		$stmt_paging ->bind_param('sss', $bind_keyword, $from, $offset);
	// 	}
	// 	// Execute query
	// 	$stmt_paging ->execute();
	// 	// store result
	// 	$stmt_paging ->store_result();
	//
	// 	$stmt_paging->bind_result($data['Menu_ID'],
	// 			$data['Menu_name'],
	// 			$data['Category_name'],
	// 			$data['Price'],
	// 			$data['Serve_for'],
	// 			$data['Menu_image'],
	// 			$data['Quantity']
	// 			);
	//
	// 	// for paging purpose
	// 	$total_records_paging = $total_records;
	// }

	// if no data on database show "No Reservation is Available"
	if($total_records == 0){

?>
	<h1>Menu Not Available
		<a href="buku-add.php">
			<button class="btn btn-success">Add New Menu</button>
		</a>
	</h1>
	<hr />

	<?php
		// otherwise, show data
		}else{
			// $row_number = $from + 1;
	?>
	<div class="col-md-12">
		<h1>
			Menu List
			<hr/>
		</h1>
	</div>
	<!-- search form -->
	<!-- <form class="list_header" method="get">
		<div class="col-md-12">
			<p class="pholder">Search by Name : </p>
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control" name="keyword" />
		</div>
		<br>
			&nbsp;&nbsp;&nbsp;
			<input type="submit" class="btn btn-primary" name="btnSearch" value="Search" />
	</form> -->
	<!-- end of search form -->
	<br/>
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-default">
				<div class="panel-heading">
					Advanced Tables
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<p>
							<a href="buku-add.php">
								<button class="btn btn-success">Add New Menu</button>
							</a>
						</p>
						<table class='table table-striped table-bordered table-hover' id="dataTables-example">
							<thead>
								<tr class="warning">
									<th>Cover</th>
									<th>Judul Buku</th>
									<th>Penulis</th>
									<th>Jenis</th>
									<th>Status</th>
									<th>File</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								// foreach($connect->query('SELECT f.id_buku,f.id_buku,b.id_buku
								// 											FROM  file f
								// 											LEFT JOIN buku b ON f.id_buku = b.id_buku
								// 											WHERE id_buku=?') as $row) {

								// }
							$no=0;
						  $result=mysqli_query($connect,"select f.id_buku,f.id_buku, f.judul_file, b.id_buku
																  from buku f
																  left join file b on b.id_buku = f.id_buku ");
							 while($obj=mysqli_fetch_object($result)){
							 		$no++;
									echo $obj->judul_buku;
							 };
							 $e = mysqli_num_rows($result);
							 echo $e;
								// get all data using while loop
								while ($stmt->fetch()){

								?>

									<tr>
										<td width="10%"><img src="<?php echo $data['Menu_image']; ?>" width="60" height="40"/></td>
										<td><?php echo $data['judul_buku'];?></td>
										<td><?php echo $data['penulis_buku'];?></td>
										<td><?php echo $data['nama_jenis'];?></td>
										<td><?php echo $data['Serve_for'];?> - <?php echo $data['jumlah_buku'];?> books</td>
										<td><?php echo $no;?> files</td>
										<!-- <td><?php //echo $data['Price']." ".$currency;?></td> -->
										<!-- <td width="15%"><?php //echo $data['Category_name'];?></td> -->
										<td width="15%">
											<a href="menu-detail.php?id=<?php echo $data['Menu_ID'];?>" class="btn btn-info">
												<i class="fa fa-eye"></i>
											</a>&nbsp;

											<a href="edit-menu.php?id=<?php echo $data['Menu_ID'];?>" class="btn btn-warning">
												<i class="fa fa-edit"></i>
											</a>&nbsp;

											<a href="delete-menu.php?id=<?php echo $data['Menu_ID'];?>" class="btn btn-danger">
												<i class="fa fa-trash-o"></i>
											</a>
										</td>
									</tr>
								<?php }
							}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end Advanced Tables -->
		</div>
	</div>
	<!-- end Row -->
	</div>

	<div class="col-md-12">
	<h4>
		<?php
			// for pagination purpose
			// $function->doPages($offset, 'menu.php', '', $total_records, $keyword);
		?>
	</h4>
	</div>

	<div class="separator"> </div>
<?php
	$stmt->close();
	include_once('../model/close_database.php');
	include_once('layout/footer.php');

?>
