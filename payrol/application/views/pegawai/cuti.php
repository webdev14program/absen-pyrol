    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Izin Cuti hanya diberikan untuk pegawai yang sudah bekerja selama 1 tahun ( Tidak terpotong gaji )<br>
              Izin Tidak masuk diberikan untuk siapa saja ( Dipotong gaji FULL ) <br>
              Izin Sakit masuk diberikan untuk siapa saja dibuktikan dengan surat keterangan dokter ( Tidak terpotong gaji )
            </div>
            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?=$title?> </h3>
                  <a style="float: right;" href="<?=base_url('pegawai/cuti_add')?>" class="btn btn-sm btn-primary">Tambah data</a>
              </div>
              <div class="card-body table-responsive">
                <table id="table" class="table table-bordered table-striped text-center">
                    <thead>
                      <th width="1%">No</th>
                      <th>Nama</th>
                      <th>Jenis</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Opsi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($data as $d) { 
                        $cek = $this->db->query(" select min(tanggal) as mulai,max(tanggal) as akhir from detailcuti where id_cuti = '$d->id_cuti' ")->row();
                      ?>
                      <tr>
                        <td width="1%"><?=$no++?></td>
                        <td><?=ucfirst($d->nama)?></td>
                        <td><?=ucfirst($d->jenis_cuti)?></td>
                        <td>
                        <?php
                        $awal = $cek->mulai;
                        $akhir = $cek->akhir;
                        $format_awal = strtotime($awal);
                        $format_akhir = strtotime($akhir);

                        $haribiasa = array();
                        $harisabtuminggu = array();

                        for ($i = $format_awal; $i <= $format_akhir; $i += (60 * 60 * 24)) {
                          if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                            $haribiasa[] = $i;
                          } else {
                            $harisabtuminggu[] = $i;
                          }
                        }

                        $jumlah = count($haribiasa);
                        $jumlahsabtuminggu = count($harisabtuminggu);
                        $totallama = $jumlah + $jumlahsabtuminggu;


                        echo $totallama, " Hari";
                        ?>
                        <?php
                        $waktu_mulai = strtotime($cek->mulai);
                        $waktu_akhir = strtotime($cek->akhir);
                        $bulanawal = date('F',$waktu_mulai);
                        if ($bulanawal == "January") {
                          $nama_bulan = "Januari";
                        } else if ($bulanawal == "February") {
                          $nama_bulan = "Februari";
                        } else if ($bulanawal == "March") {
                          $nama_bulan = "Maret";
                        } else if ($bulanawal == "April") {
                          $nama_bulan = "April";
                        } else if ($bulanawal == "May") {
                          $nama_bulan = "Mei";
                        } else if ($bulanawal == "June") {
                          $nama_bulan = "Juni";
                        } else if ($bulanawal == "July") {
                          $nama_bulan = "Juli";
                        } else if ($bulanawal == "August") {
                          $nama_bulan = "Agustus";
                        } else if ($bulanawal == "September") {
                          $nama_bulan = "September";
                        } else if ($bulanawal == "October") {
                          $nama_bulan = "Oktober";
                        } else if ($bulanawal == "November") {
                          $nama_bulan = "November";
                        } elseif ($bulanawal == "December") {
                          $nama_bulan = "Desember";
                        }
                        $bulanakhir = date('F', $waktu_akhir);
                        if ($bulanakhir == "January") {
                          $nama_bulan = "Januari";
                        } else if ($bulanakhir == "February") {
                          $nama_bulan = "Februari";
                        } else if ($bulanakhir == "March") {
                          $nama_bulan = "Maret";
                        } else if ($bulanakhir == "April") {
                          $nama_bulan = "April";
                        } else if ($bulanakhir == "May") {
                          $nama_bulan = "Mei";
                        } else if ($bulanakhir == "June") {
                          $nama_bulan = "Juni";
                        } else if ($bulanakhir == "July") {
                          $nama_bulan = "Juli";
                        } else if ($bulanakhir == "August") {
                          $nama_bulan = "Agustus";
                        } else if ($bulanakhir == "September") {
                          $nama_bulan = "September";
                        } else if ($bulanakhir == "October") {
                          $nama_bulan = "Oktober";
                        } else if ($bulanakhir == "November") {
                          $nama_bulan = "November";
                        } elseif ($bulanakhir == "December") {
                          $nama_bulan = "Desember";
                        }
                        echo "( ",date('d',$waktu_mulai)," ",$nama_bulan," ",date('Y',$waktu_mulai)," - ",date('d',$waktu_akhir)," ",$nama_bulan," ",date('Y',$waktu_akhir)," )";
                        ?></td>
                        <td>
                          <?=ucfirst($d->alasan)?><br>
                          <?php if ($d->jenis_cuti == 'sakit') { ?>
                            <small>Bukti  <a target="_blank" href="<?=base_url('bukti/'.$d->bukti)?>" >Klik disini</a></small>
                          <?php } ?>
                        </td>
                        <td><?=ucfirst($d->status_cuti)?></td>
                        <td>
                          <?php if ($d->status_cuti == 'diajukan') { ?>
                          <a onclick="return confirm('apakah anda yakin ingin menghapus pengajuan cuti ini?')" href="<?=base_url('pegawai/cuti_delete/'.$d->id_cuti)?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                          <?php } ?>
                          <?php if ($d->status_cuti == 'diterima') { ?>
                            <button class="btn btn-primary btn-sm">Pengajuan anda diterima</button>
                          <?php } ?>
                          <?php if ($d->status_cuti == 'ditolak') { ?>
                            <button class="btn btn-danger btn-sm">Pengajuan anda ditolak</button>
                          <?php } ?>
                        </td>
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