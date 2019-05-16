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
  $sql_query = "SELECT id_buku, judul_buku, nama_jenis, penulis_buku, subjek_buku, Serve_for, kode_buku, penerbit, tahun_terbit, no_seri, status_buku, ringkasan, cover_buku, jumlah_buku, tanggal_entri
      FROM buku b, jenis j
      WHERE b.id_jenis = j.id_jenis
      ORDER BY b.id_buku DESC";
