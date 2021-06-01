    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?= $title ?> </h3>
                <a style="float: right;" href="<?= base_url('admin/absen_add') ?>" class="btn btn-sm btn-primary">Tambah data</a>
              </div>
              <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table-striped text-center">
                  <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                  </thead>
                  <tbody>

                    <?php $no = 1;
                    foreach ($data as $d) { ?>
                      <tr>
                        <td width="1%"><?= $no++ ?></td>
                        <td><?= $d['nama'] ?></td>
                        <td><?php
                        $waktu =  $d['waktu'];
                        $date = strtotime($waktu);
                        $formattanggal = date('Y-m-d',$date);
                        $formatwaktu = date('H:i:s',$date);
                        $dateformat = date('D', $date);
                        $timeformat = date('H',$date);
                        if ($dateformat == "Sun") {
                            $nama_hari = "Minggu";
                        } else if ($dateformat == "Mon") {
                            $nama_hari = "Senin";
                        } else if ($dateformat == "Tue") {
                            $nama_hari = "Selasa";
                        } else if ($dateformat == "Wed") {
                            $nama_hari = "Rabu";
                        } else if ($dateformat == "Thu") {
                            $nama_hari = "Kamis";
                        } else if ($dateformat == "Fri") {
                            $nama_hari = "Jumat";
                        } else if ($dateformat == "Sat") {
                            $nama_hari = "Sabtu";
                        }
                        $formatbulan = date('F', $date);
                        if ($formatbulan == "January") {
                            $nama_bulan = "Januari";
                        } else if ($formatbulan == "February") {
                            $nama_bulan = "Februari";
                        } else if ($formatbulan == "March") {
                            $nama_bulan = "Maret";
                        } else if ($formatbulan == "April") {
                            $nama_bulan = "April";
                        } else if ($formatbulan == "May") {
                            $nama_bulan = "Mei";
                        } else if ($formatbulan == "June") {
                            $nama_bulan = "Juni";
                        } else if ($formatbulan == "July") {
                            $nama_bulan = "Juli";
                        } else if ($formatbulan == "August") {
                            $nama_bulan = "Agustus";
                        } else if ($formatbulan == "September") {
                            $nama_bulan = "September";
                        } else if ($formatbulan == "October") {
                            $nama_bulan = "Oktober";
                        } else if ($formatbulan == "November") {
                            $nama_bulan = "November";
                        } elseif ($formatbulan == "December") {
                            $nama_bulan = "Desember";
                        }
                        if($timeformat >= "01" && $timeformat <= "11"){
                          $ketwaktu = "Pagi";
                        }
                        else if($timeformat >= "12" && $timeformat <= "15"){
                            $ketwaktu = "Siang";
                        }else if($timeformat >="16" && $timeformat <= "18"){
                              $ketwaktu = "Sore";
                        }else{
                          $ketwaktu = "Malam";
                        }
                        echo "Tanggal: "." ".$nama_hari, ", ",date('d', $date), " ", $nama_bulan, " ", date('Y', $date)." Waktu: ".date('h:i',$date)," ",$ketwaktu;
                         ?></td>
                        <td><?php
                        $ket =  $d['keterangan'];
                        if($ket == 'masuk'){
                          $x = 'Masuk';
                        }else{
                          $x = 'Pulang';
                        }echo $x;
                        ?></td>
                        <td><?= $d['status'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
