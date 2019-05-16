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
		$sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
				FROM tbl_menu m, tbl_category c
				WHERE m.Category_ID = c.Category_ID
				ORDER BY m.Menu_ID DESC";
	}else{
		$sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
				FROM tbl_menu m, tbl_category c
				WHERE m.Category_ID = c.Category_ID AND Menu_name LIKE ?
				ORDER BY m.Menu_ID DESC";
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
		$stmt->bind_result($data['Menu_ID'],
				$data['Menu_name'],
				$data['Category_name'],
				$data['Price'],
				$data['Serve_for'],
				$data['Menu_image'],
				$data['Quantity']
				);

		// get total records
		$total_records = $stmt->num_rows;
	}

	// check page parameter
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}

	// number of data that will be display per page
	$offset = 10;

	//lets calculate the LIMIT for SQL, and save it $from
	if ($page){
		$from 	= ($page * $offset) - $offset;
	}else{
		//if nothing was given in page request, lets load the first page
		$from = 0;
	}

	// get all data from reservation table
	if(empty($keyword)){
		$sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
				FROM tbl_menu m, tbl_category c
				WHERE m.Category_ID = c.Category_ID
				ORDER BY m.Menu_ID DESC LIMIT ?, ?";
	}else{
		$sql_query = "SELECT Menu_ID, Menu_name, Category_name, Price, Serve_for, Menu_image, Quantity
				FROM tbl_menu m, tbl_category c
				WHERE m.Category_ID = c.Category_ID AND Menu_name LIKE ?
				ORDER BY m.Menu_ID DESC LIMIT ?, ?";
	}

	$stmt_paging = $connect->stmt_init();
	if($stmt_paging ->prepare($sql_query)) {
		// Bind your variables to replace the ?s
		if(empty($keyword)){
			$stmt_paging ->bind_param('ss', $from, $offset);
		}else{
			$stmt_paging ->bind_param('sss', $bind_keyword, $from, $offset);
		}
		// Execute query
		$stmt_paging ->execute();
		// store result
		$stmt_paging ->store_result();

		$stmt_paging->bind_result($data['Menu_ID'],
				$data['Menu_name'],
				$data['Category_name'],
				$data['Price'],
				$data['Serve_for'],
				$data['Menu_image'],
				$data['Quantity']
				);

		// for paging purpose
		$total_records_paging = $total_records;
	}

	// if no data on database show "No Reservation is Available"
	if($total_records_paging == 0){

?>
	<h1>Menu Not Available
		<a href="add-menu.php">
			<button class="btn btn-danger">Add New Menu</button>
		</a>
	</h1>
	<hr />

	<?php
		// otherwise, show data
		}else{
			$row_number = $from + 1;
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
							<a href="add-menu.php">
								<button class="btn btn-danger">Add New Menu</button>
							</a>
						</p>
						<table class='table table-striped table-bordered table-hover' id="dataTables-example">
							<thead>
								<tr class="warning">
									<th>Name</th>
									<th>Image</th>
									<th>Status</th>
									<th>Stock</th>
									<th>Price</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								// get all data using while loop
								while ($stmt_paging->fetch()){ ?>
									<tr class="odd gradeX">
										<td><?php echo $data['Menu_name'];?></td>
										<td width="10%"><img src="<?php echo $data['Menu_image']; ?>" width="60" height="40"/></td>
										<td><?php echo $data['Serve_for'];?></td>
										<td><?php echo $data['Quantity'];?></td>
										<td><?php echo $data['Price']." ".$currency;?></td>
										<td width="15%"><?php echo $data['Category_name'];?></td>
										<td width="15%">
											<a href="menu-detail.php?id=<?php echo $data['Menu_ID'];?>">
												View
											</a>&nbsp;

											<a href="edit-menu.php?id=<?php echo $data['Menu_ID'];?>">
												Edit
											</a>&nbsp;

											<a href="delete-menu.php?id=<?php echo $data['Menu_ID'];?>">
												Delete
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
			$function->doPages($offset, 'menu.php', '', $total_records, $keyword);
		?>
	</h4>
	</div>

	<div class="separator"> </div>
<?php
	$stmt->close();
	include_once('../model/close_database.php');
	include_once('layout/footer.php');

?>
