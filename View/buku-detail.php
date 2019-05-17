<?php
	include_once('../model/connect.php');
?>


	<?php
		// if(isset($_GET['id'])){
		// 	$ID = $_GET['id'];
		// }else{
		// 	$ID = "";
		// }
    //
		// // create array variable to store data from database
		// $data = array();
    //
		// // get currency symbol from setting table
		// $sql_query = "SELECT Value
		// 		FROM tbl_setting
		// 		WHERE Variable = 'Currency'";
    //
		// $stmt = $connect->stmt_init();
		// if($stmt->prepare($sql_query)) {
		// 	// Execute query
		// 	$stmt->execute();
		// 	// store result
		// 	$stmt->store_result();
		// 	$stmt->bind_result($currency);
		// 	$stmt->fetch();
		// 	$stmt->close();
		// }
    //
		// // get all data from menu table and category table
    // // $sql_query = "SELECT Menu_ID, Menu_name, Serve_for, Price, Category_name, Menu_image, Description
		// 		// FROM tbl_menu m, tbl_category c
		// 		// WHERE m.Menu_ID = ? AND m.Category_ID = c.Category_ID";
    //   $sql_query = "SELECT id_buku, judul_buku, nama_jenis, penulis_buku, subjek_buku, Serve_for, kode_buku, penerbit, tahun_terbit, status_buku, ringkasan, cover_buku, jumlah_buku
    //     FROM buku b, jenis j
		// 		WHERE b.id_buku = ? AND b.id_jenis = j.id_jenis";
    //
    // // $stmt = $connect->stmt_init();
		// if($stmt=$connect->prepare($sql_query)) {
		// 	// Bind your variables to replace the ?s
		// 	$stmt->bind_param('s', $ID);
		// 	// Execute query
		// 	$stmt->execute();
		// 	// store result
		// 	$stmt->store_result();
    //   $stmt->bind_result($data['id_buku'],
  	// 			$data['judul_buku'],
  	// 			$data['nama_jenis'],
  	// 			$data['penulis_buku'],
  	// 			$data['subjek_buku'],
  	// 			$data['Serve_for'],
  	// 			$data['kode_buku'],
  	// 			$data['penerbit'],
  	// 			$data['tahun_terbit'],
  	// 			$data['status_buku'],
  	// 			$data['ringkasan'],
  	// 			$data['cover_buku'],
    //       $data['jumlah_buku']
  	// 			);
		// 	// $stmt->fetch();
		// 	// $stmt->close();
		// }

	?>

  <button class="btn btn-info btn-md" data-toggle="modal" data-target="#Detail<?php echo $data['id_buku']; ?>" title="Detail Buku">
    <i class="fa fa-eye"></i>
  </button>
  <div class="modal fade" id="Detail<?php echo $data['id_buku']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Detail Data Buku : <?php echo $data['judul_buku'];?></h4>
              </div>
              <div class="modal-body">
          			<table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="30%">Judul Buku</th>
                      <th>: <?php echo $data['judul_buku']; ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Penulis</td>
                      <th>: <?php echo $data['penulis_buku']; ?></th>
                    </tr>
                    <tr>
                      <td>Jenis Buku</td>
                      <th>: <?php echo $data['nama_jenis']; ?></th>
                    </tr>
                    <tr>
                      <td>Kode Buku</td>
                      <th>: <?php echo $data['kode_buku']; ?></th>
                    </tr>
                    <tr>
                      <td>Penerbit</td>
                      <th>: <?php echo $data['penerbit']; ?></th>
                    </tr>
                    <tr>
                      <td>Tahun Terbit</td>
                      <th>: <?php echo $data['tahun_terbit']; ?></th>
                    </tr>
                    <tr>
                      <td>Subjek Buku</td>
                      <th>: <?php echo $data['subjek_buku']; ?></th>
                    </tr>
                    <tr>
                      <td>Status Buku</td>
                      <th>: <?php echo $data['status_buku']; ?></th>
                    </tr>
                    <tr>
                      <td>Ringkasan</td>
                      <th>: <?php echo $data['ringkasan']; ?></th>
                    </tr>
                    <tr>
                      <td>Jumlah Buku</td>
                      <th>: <?php echo $data['jumlah_buku']; ?> - <?php echo $data['Serve_for']; ?></th>
                    </tr>
                    <!-- <tr class="row">
              				<th class="detail">Price</th>
              				<td class="detail"><?php //echo $data['Price']." ".$currency; ?></td>
              			</tr> -->
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <a href="delete-menu.php?id=<?php echo $data['id_buku']; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Yes. Delete this Data</a>
                <a href="edit-menu.php?id=<?php echo $data['id_buku']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit this Data</a>
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
              </div>
          </div>
      </div>
  </div>

<?php include_once('../model/close_database.php'); ?>
