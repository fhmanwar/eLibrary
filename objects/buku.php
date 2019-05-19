<?php
	//include class model
	include "Model/model.php";

	class controller{
		//variabel public
		public $model;

		//inisialisasi awal untuk class
		function __construct(){
			$this->model = new model(); //variabel model merupakan objek baru yang dibuat dari class model
		}

		function index(){
			$data = $this->model->selectAll(); //pada class ini (controller), akses variabel model, akses fungsi selectAll (kalo bingung lihat di class model ada fungsi selectAll)
			include "View/view.php"; //memamnggil view.php pada folder view
		}

		function viewEdit($kd_brg){
			$data = $this->model->selectBrg($kd_brg); //select data Barang dengan kd_brg ...
			$row = $this->model->fetch($data); //fetch hasil select
			include "View/view_edit.php"; //menampilkan halaman untuk mengedit data
		}

		function viewInsert(){
			include "View/view_add.php"; //menampilkan halaman add data
		}

		//fungsi updata data
		function update(){
			$kd_brg = $_POST['kd_brg'];
			$nm_brg = $_POST['nm_brg'];
			$satuan = $_POST['satuan'];
			$harga = $_POST['harga'];
			$harga_beli = $_POST['harga_beli'];
			$stok = $_POST['stok'];
			$stok_min = $_POST['stok_min'];

			$update = $this->model->updateBrg($kd_brg, $nm_brg, $satuan, $harga, $harga_beli, $stok, $stok_min);
			header("location:index.php");
		}

		function delete($kd_brg){
			$delete = $this->model->deleteBrg($kd_brg);
			header("location:index.php");
		}

		function insert(){
			$kd_brg = $_POST['kd_brg'];
			$nm_brg = $_POST['nm_brg'];
			$satuan = $_POST['satuan'];
			$harga = $_POST['harga'];
			$harga_beli = $_POST['harga_beli'];
			$stok = $_POST['stok'];
			$stok_min = $_POST['stok_min'];

			$insert = $this->model->insertBrg($kd_brg, $nm_brg, $satuan, $harga, $harga_beli, $stok, $stok_min);
			header("location:index.php");
		}

		function __destruct(){

		}
	}
?>
