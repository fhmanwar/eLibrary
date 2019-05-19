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
                      <th>: <?php echo $data['jumlah_buku']; ?> books - <?php echo $data['Serve_for']; ?></th>
                    </tr>
                    <!-- <tr class="row">
              				<th class="detail">Price</th>
              				<td class="detail"><?php //echo $data['Price']." ".$currency; ?></td>
              			</tr> -->
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <a href="buku-delete.php?id=<?php echo $data['id_buku']; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Yes. Delete this Data</a>
                <a href="buku-edit.php?id=<?php echo $data['id_buku']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit this Data</a>
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
              </div>
          </div>
      </div>
  </div>
