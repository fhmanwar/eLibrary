<?php

	if(isset($_POST['btnDelete'])){
		if(isset($_GET['id'])){
			$ID = $_GET['id'];
		}else{
			$ID = "";
		}

		// get image file from menu table
		$sql_query = "SELECT Menu_image
				FROM tbl_menu
				WHERE Menu_ID = ?";

		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $ID);
			// Execute query
			$stmt->execute();
			// store result
			$stmt->store_result();
			$stmt->bind_result($menu_image);
			$stmt->fetch();
			$stmt->close();
		}

		// delete image file from directory
		$delete = unlink("$menu_image");

		// delete data from menu table
		$sql_query = "DELETE FROM tbl_menu
				WHERE Menu_ID = ?";

		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $ID);
			// Execute query
			$stmt->execute();
			// store result
			$delete_result = $stmt->store_result();
			$stmt->close();
		}

		// if delete data success back to reservation page
		if($delete_result){
			header("location: buku-list.php");
		}
	}

	if(isset($_POST['btnNo'])){
		header("location: buku-list.php");
	}

?>
  <button class="btn btn-danger btn-md" data-toggle="modal" data-target="#Delete<?php echo $data['id_buku']; ?>" title="Delete Buku">
    <i class="fa fa-trash-o"></i>
  </button>
  <div class="modal fade" id="Delete<?php echo $data['id_buku']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Delete Data Buku : <?php echo $data['judul_buku']; ?></h4>
              </div>
              <div class="modal-body">
          			<p class="alert alert-warning">Are you sure want to delete this data?</p>
              </div>
              <div class="modal-footer">
                <button  class="btn btn-danger"><i class="fa fa-trash-o"></i> Yes. Delete this Data</button>
                <a href="buku-edit.php?id=<?php echo $data['id_buku']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit this Data</a>
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- <div id="content" class="container col-md-12">
	<h1>Confirm Action</h1>
	<hr />
	<form method="post">
		<p>Are you sure want to delete this ?</p>
		<input type="submit" class="btn btn-primary" value="Delete" name="btnDelete"/>
		<input type="submit" class="btn btn-danger" value="Cancel" name="btnNo"/>
	</form>
	<div class="separator"> </div>
</div> -->
