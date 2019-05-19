<?php
// include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/config/database.php';
// include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/objects/buku.php';
// include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/objects/jenis.php';
include $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/View/layout/header.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$buku = new Buku($db);
$jenis = new Jenis($db);

// set page headers
$page_title = "Create Product";

if($_POST){

    // set product property values
  	$buku->id_jenis = $_POST['id_jenis'];
	$buku->judul = $_POST['judul'];
	$buku->penulis = $_POST['penulis'];
	$buku->subjek = $_POST['subjek'];
	$buku->serve_for = $_POST['serve_for'];
	$buku->kode_buku = $_POST['kode_buku'];
	$buku->penerbit = $_POST['penerbit'];
	$buku->tahun_terbit = $_POST['tahun_terbit'];
	$buku->status = $_POST['status'];
	$buku->ringkasan = $_POST['ringkasan'];
	$buku->jml_buku = $_POST['jml_buku'];

    $image=!empty($_FILES["image"]["name"])
			? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
    $buku->image = $image;
    // $buku->price = $_POST['price'];

    // create the product
    if($buku->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $buku->uploadPhoto();
    }

    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>
	<div class="col-md-12">
		<h1>Add Menu</h1>
		<hr />
	</div>


<div class="col-md-12">
	<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="col-md-12">
			<div class="form-group form-group-lg">
				<label>Judul Buku</label>
				<input type="text" name="judul" class="form-control" placeholder="Judul Buku" required>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group form-group-lg">
				<label>Penulis/Pengarang Buku</label>
				<input type="text" name="penulis" class="form-control" placeholder="Penulis Buku" required>
			</div>

			<div class="form-group form-group-lg">
				<label>Kode Buku</label>
				<input type="text" name="kode_buku" class="form-control" placeholder="Kode Buku" >
			</div>

			<div class="form-group form-group-lg">
				<label>Jenis Buku</label>
				<?php $stmt = $jenis->read(); ?>
				<select name="id_jenis" class="form-control">
					<?php
					while($row_jenis = $stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row_jenis);
					?>
						<option value='<?php $id ?>'><?php echo $nama_jenis ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group form-group-lg">
				<label>Serve For</label>
				<select name="serve_for" class="form-control">
					<option value="Available">Available</option>
					<option value="Sold_Out">Sold Out</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">

			<div class="form-group form-group-lg">
				<label>Subjek Buku</label>
				<input type="text" name="subjek" class="form-control" placeholder="Subjek Buku" >
			</div>

			<div class="form-group form-group-lg">
				<label>Penerbit Buku</label>
				<input type="text" name="penerbit" class="form-control" placeholder="Penerbit Buku">
			</div>

			<div class="form-group form-group-lg">
				<label>Tahun Terbit</label>
				<input type="number" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit" >
			</div>

			<div class="form-group form-group-lg">
				<label>Jumlah Buku</label>
				<input type="number" name="jml_buku" class="form-control" placeholder="Jumlah Buku">
			</div>

		</div>

		<div class="col-md-4">
			<div class="form-group form-group-lg">
				<label>Uploud Cover Buku</label>
				<input type="file" name="image" id="cover" class="form-control" placeholder="Uploud Cover Buku">
			</div>

			<div class="form-group form-group-lg">
				<label>status Buku </label>
				<select name="status" class="form-control">
					<option value="Publish">Publish</option>
					<option value="Not_Publish">Not Publish</option>
					<option value="Missing">Missing</option>
				</select>
			</div>

			<div class="form-group form-group-lg">
				<label>Description</label></label>
				<textarea name="ringkasan" class="form-control editor" rows="16" placeholder="Ringkasan"></textarea>
			</div>

		</div>

		<div class="col-md-12 text-center">
			<div class="form-group form-group-lg">
				<input type="submit" name="submit" class="btn btn-primary btn-lg" value="Save Data">
				<input type="reset" class="btn btn-default btn-lg" value="Reset">
			</div>
		</div>

	</form>
	</div>
	<div class="separator"> </div>


<?php
	include '../layout/footer.php';
?>
