    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <!-- <div class="card-header"> <?= $title ?> </h3>
                <a style="float: right;" href="<?= base_url('admin/penggajian_add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
              </div> -->
              <div class="card-body table-responsive">
                <table border="1" id="myTable" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Pegawai</th>
                      <th>Nama Pegawai</th>
                      <th>Gaji Pokok</th>
                      <th>Tunjangan</th>
                      <th>Uang Makan</th>
                      <th>Insentif</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $no = 1;
                    foreach ($list as $data) {
                      // $tahun  = date('Y');
                      // $bulan  = date('m');
                      // $jumlah = 0;
                      // $stotal = 0;
                      // $absen  = $this->M_data->absenbulan($data->kode_pegawai,$tahun,$bulan)->num_rows();
                      // $cuti   = $this->M_data->cutibulan($data->kode_pegawai,$tahun,$bulan)->num_rows();
                      // $sakit  = $this->M_data->sakitbulan($data->kode_pegawai,$tahun,$bulan)->num_rows();
                      // $izin   = $this->M_data->izinbulan($data->kode_pegawai,$tahun,$bulan)->num_rows();

                      $gaji = 0;
                      $tunjangan = 0;
                      $insentif = 0;
                      $uangmakan = 0;
                      // $gaji   = ($absen * $data->gaji_pokok) + ($cuti * $data->gaji_pokok) + ($sakit * $data->gaji_pokok);
                      //var_dump($cuti);
                      //hitung hari cuti
                    ?>
                      <tr>
                        <td width="1%"><?= $no++ ?></td>
                        <td><?= ucfirst($data->kode_pegawai) ?></td>
                        <td><?= ucfirst($data->nama) ?></td>
                        <td>Rp. <?= number_format($gaji) ?></td>
                        <td>Rp. <?= number_format($tunjangan) ?></td>
                        <td>Rp. <?= number_format($uangmakan) ?></td>
                        <td>Rp. <?= number_format($insentif) ?></td>
                        <td>
                          <a href="#" id="kliklihat" class="btn btn-primary btn-sm"><span class="fa fa-eye" data-toggle="modal" data-target="#exampleModal"></span></a>
                          <a href="<?= base_url('admin/penggajian_edit/' . $data->kode_pegawai) ?>" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                          <a onclick="return confirm('apakah anda yakin ingin menghapus pegawai ini?')" href="#" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-body table-responsive">
                  <table border="1" id="myTable" class="table table-bordered table-striped text-center">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Pegawai</th>
                        <th>Nama</th>
                        <th>Hadir/bulan</th>
                        <th>Cut/bulan</th>
                        <th>Izin/bulan</th>
                        <th>Sakit/bulan</th>
                        <th>Gaji</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $no = 1;
                      foreach ($list as $data) {
                        $tahun  = date('Y');
                        $bulan  = date('m');
                        $jumlah = 0;
                        $stotal = 0;
                        $absen  = $this->M_data->absenbulan($data->kode_pegawai, $tahun, $bulan)->num_rows();
                        $cuti   = $this->M_data->cutibulan($data->kode_pegawai, $tahun, $bulan)->num_rows();
                        $sakit  = $this->M_data->sakitbulan($data->kode_pegawai, $tahun, $bulan)->num_rows();
                        $izin   = $this->M_data->izinbulan($data->kode_pegawai, $tahun, $bulan)->num_rows();

                        $gaji = 0;
                        // $gaji   = ($absen * $data->gaji) + ($cuti * $data->gaji) + ($sakit * $data->gaji);
                        //var_dump($cuti);
                        //hitung hari cuti
                      ?>
                        <tr>
                          <td width="1%"><?= $no++ ?></td>
                          <td><?= ucfirst($data->kode_pegawai) ?></td>
                          <td><?= ucfirst($data->nama) ?></td>
                          <td><?= $absen ?></td>
                          <td><?= $cuti ?></td>
                          <td><?= $izin ?></td>
                          <td><?= $sakit ?></td>
                          <td>Rp. <?= number_format($gaji) ?></td>
                          <td> <a href="<?= base_url('admin/penggajian_add/' . $data->kode_pegawai) ?>" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data Penggajian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Nama Pegawai &nbsp: </label><br>
            <label>Gaji Pokok &nbsp:</label><br>
            <label>Tunjangan &nbsp:</label><br>
            <label>Pinjaman &nbsp:</label><br>
            <label>Uang Makan &nbsp:</label><br>
            <label>Uang Lembur &nbsp:</label><br>
            <label>Insentif &nbsp:</label><br>
            <label>BPJS Kesehatan &nbsp:</label><br>
            <label>BPJS Tenaga Kerja &nbsp:</label><br>
            <label>Uang Vaksin &nbsp:</label><br>
            <label>Uang Sanski &nbsp:</label><br>
            <label>Uang THP &nbsp:</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    </section>
    </div>
    </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
      $("#kliklihat").click(function(){
        var userid = $(this).data('id');
      });
    </script>
