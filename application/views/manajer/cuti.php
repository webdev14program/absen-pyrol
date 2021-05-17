    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">

                    <!-- Map card -->
                    <div class="card">
                        <div class="card-header"> <?= $title ?> </h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="myTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <th width="1%">No</th>
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
                                        $cek = $this->db->query(" select min(tanggal) as mulai,max(tanggal) as akhir from detailcuti where id_cuti = '$d->id_cuti' ")->row();
                                    ?>
                                        <tr>
                                            <td width="1%"><?= $no++ ?></td>
                                            <td><?= ucfirst($d->nama) ?></td>
                                            <td><?= ucfirst($d->jenis_cuti) ?></td>
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
                                            <td>
                                                <?= ucfirst($d->alasan) ?><br>
                                                <?php if ($d->jenis_cuti == 'sakit') { ?>
                                                    <small>Bukti <a target="_blank" href="<?= base_url('bukti/' . $d->bukti) ?>">Klik disini</a></small>
                                                <?php } ?>
                                            </td>
                                            <td><?= ucfirst($d->status_cuti) ?></td>
                                            <td>
                                                <?php if ($d->status_cuti == 'diajukan') { ?>
                                                    <a onclick="return confirm('apakah anda yakin ingin menerima pengajuan cuti ini?')" href="<?= base_url('manajer/cuti_terima/' . $d->id_cuti) ?>" class="btn btn-primary btn-sm"><span class="fa fa-check"></span></a>
                                                    <a onclick="return confirm('apakah anda yakin ingin menolak pengajuan cuti ini?')" href="<?= base_url('manajer/cuti_tolak/' . $d->id_cuti) ?>" class="btn btn-danger btn-sm"><span class="fa fa-times"></span></a>
                                                <?php } ?>
                                                <?php if ($d->status_cuti == 'diterima') { ?>
                                                    <button class="btn btn-primary btn-sm">Anda menerima pengajuan</button>
                                                <?php } ?>
                                                <?php if ($d->status_cuti == 'ditolak') { ?>
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