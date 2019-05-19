<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/config/core.php';

// include database and object files
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/objects/buku.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/objects/jenis.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);
$jenis = new Jenis($db);

$title = "Buku";

include '../layout/head.php';
include '../layout/header.php';
include '../layout/nav.php';
// query products
$stmt = $buku->readAll();

// specify the page where paging is used
$page_url = "index.php?";

// count total rows - used for pagination
$total_rows=$buku->countAll();
?>
	<div class="col-md-12">
		<h1>
		<?php echo $title; ?>
			<hr/>
		</h1>
	</div>

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
						<?php if($total_rows>0){ ?>
						
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
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								extract($row);
							?>

							<tr>
								<td width="10%"><img src="<?php echo $row['image'] ?>" width="60" height="40"/></td>
								<td><?php echo $judul ?></td>
								<td><?php echo $penulis ?></td>
								<td>
								<?php 
								$jenis->id = $id_jenis;
								$jenis->readName();
								echo $jenis->nama_jenis;
								?>
								</td>
								<td><?php echo $serve_for?> - <?php echo $jml_buku?> books</td>
								<td><?php //if($x == $data['judul_buku']){echo $no;}else{echo 0;}?> files</td>
								<!-- <td><?php //echo $data['Price']." ".$currency;?></td> -->
								<td width="15%">
								<?php include('buku-detail.php');?>

								<a href="buku-edit.php?id=<?php $id_buku?>" class="btn btn-warning">
									<i class="fa fa-edit"></i>
								</a>&nbsp;

								<?php include('buku-delete.php');?>
									
								</td>
							</tr>
							<?php }?>
							</tbody>
						</table>

						<?php }else{ ?>

						<h1>Buku Tidak Tersedia</h1>
						<hr />

						<?php } ?>
					</div>
				</div>
			</div>
			<!-- end Advanced Tables -->
		</div>
	</div>
	<!-- end Row -->
	</div>
	<div class="separator"> </div>
<?php
	include '../layout/footer.php';

?>
