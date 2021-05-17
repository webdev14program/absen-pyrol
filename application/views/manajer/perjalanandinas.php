    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">

                    <!-- Map card -->
                    <div class="card">
                        <div class="card-header"> <?= $title ?> </h3>
                            <a style="float: right;" href="<?= base_url('manajer/perjalanandinas_add') ?>" class="btn btn-sm btn-primary">Tambah data</a>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="myTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <th width="1%">No</th>
                                    <th>No. Surat</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Waktu</th>
                                    <th>Lama Cuti</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data as $d) {
                                        $cek = $this->db->query(" select min(tanggal_dinas) as mulai,max(tanggal_dinas) as akhir from detailperjalanandinas where id_perjalanan_dinas = '$d->id_perjalanan_dinas' ")->row();
                                    ?>
                                        <tr>
                                            <td width="1%"><?= $no++ ?></td>
                                            <td><?= $d->no_surat_dinas ?></td>
                                            <td><?= ucfirst($d->nama) ?></td>
                                            <td><?= ucfirst($d->nama_jabatan) ?></td>
                                            <td><?= date('d/m/Y', strtotime($cek->mulai)) ?> - <?= date('d/m/Y', strtotime($cek->akhir)) ?></td>
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
                                            </td>
                                            <td><?= ucfirst($d->ket_perjalanan_dinas) ?><br></td>
                                            <td><?= ucfirst($d->status_perjalanandinas) ?></td>
                                            <td>
                                                <?php if ($d->status_perjalanandinas == 'diajukan') { ?>
                                                    <a onclick="return confirm('apakah anda yakin ingin menerima pengajuan perjalanan dinas ini?')" href="<?= base_url('manajer/perjalanandinas_terima/' . $d->id_perjalanan_dinas) ?>" class="btn btn-primary btn-sm"><span class="fa fa-check"></span></a>
                                                    <a onclick="return confirm('apakah anda yakin ingin menolak pengajuan perjalanan dinas ini?')" href="<?= base_url('manajer/perjalanandinas_tolak/' . $d->id_perjalanan_dinas) ?>" class="btn btn-danger btn-sm"><span class="fa fa-times"></span></a>
                                                <?php } ?>
                                                <?php if ($d->status_perjalanandinas == 'diterima') { ?>
                                                    <button class="btn btn-primary btn-sm">Anda menerima pengajuan</button>
                                                <?php } ?>
                                                <?php if ($d->status_perjalanandinas == 'ditolak') { ?>
                                                    <button class="btn btn-danger btn-sm">Anda menolak pengajuan</button>
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