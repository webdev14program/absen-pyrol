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
                                    <th>Nama Pegawai</th>
                                    <th>No. SK</th>
                                    <th>Jenis Mutasi</th>
                                    <th>Departemen Lama</th>
                                    <th>Departemen Baru</th>
                                    <th>Jabatan Lama</th>
                                    <th>Jabatan Baru</th>
                                    <th>Tanggal Mutasi</th>
                                    <th>Status Mutasi</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($mutasi as $d) { ?>
                                        <tr>
                                            <td width="1%"><?= $no++ ?></td>
                                            <td><?= ucfirst($d->nama) ?></td>
                                            <td>
                                                <small><a target="_blank" href="<?= base_url('./bukti/' . $d->file_no_sk) ?>">Klik disini</a></small>
                                            </td>
                                            <td><?php
                                                $x = $d->jenis_mutasi;
                                                if ($x == 'promosi') {
                                                    echo "Promosi";
                                                } else {
                                                    echo "Mutasi";
                                                }
                                                ?></td>
                                            <td><?php
                                                $x = $d->id_departemen_lama;
                                                if ($x == 'FAT') {
                                                    echo "Finance & Tax";
                                                } else if ($x == "ITS") {
                                                    echo "IT Support";
                                                } else if ($x == "PS1") {
                                                    echo "Project Supply 1";
                                                } else if ($x == "PS2") {
                                                    echo "Project Supply 2";
                                                } else if ($x == "RS") {
                                                    echo "Ritel Sales";
                                                } else if ($x == "SEKR") {
                                                    echo "Sekretariat";
                                                } else if ($x == "SHR") {
                                                    echo "Sekretariat & Human Resources";
                                                } else if ($x == "SLS") {
                                                    echo "Sales";
                                                } else if ($x == "TKN") {
                                                    echo "Teknik";
                                                } else if ($x == "UDL") {
                                                    echo "Umum Delivery Logistik";
                                                } else {
                                                    echo "Tidak ada Departemen";
                                                }
                                                ?></td>
                                            <td><?php
                                                $x = $d->id_departemen_baru;
                                                if ($x == 'FAT') {
                                                    echo "Finance & Tax";
                                                } else if ($x == "ITS") {
                                                    echo "IT Support";
                                                } else if ($x == "PS1") {
                                                    echo "Project Supply 1";
                                                } else if ($x == "PS2") {
                                                    echo "Project Supply 2";
                                                } else if ($x == "RS") {
                                                    echo "Ritel Sales";
                                                } else if ($x == "SEKR") {
                                                    echo "Sekretariat";
                                                } else if ($x == "SHR") {
                                                    echo "Sekretariat & Human Resources";
                                                } else if ($x == "SLS") {
                                                    echo "Sales";
                                                } else if ($x == "TKN") {
                                                    echo "Teknik";
                                                } else if ($x == "UDL") {
                                                    echo "Umum Delivery Logistik";
                                                } else {
                                                    echo "Tidak ada Departemen";
                                                }
                                                ?></td>
                                            <td>
                                                <?php
                                                $x = $d->id_jabatan_lama;
                                                if ($x == "Spv") {
                                                    echo "Supervisor";
                                                } else if ($x == "Mgr") {
                                                    echo "Manager";
                                                } else {
                                                    echo "Tidak ada Jabatan";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $x = $d->id_jabatan_baru;
                                                if ($x == "Spv") {
                                                    echo "Supervisor";
                                                } else if ($x == "Mgr") {
                                                    echo "Manager";
                                                } else {
                                                    echo "Tidak ada Jabatan";
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                $time = strtotime($d->tgl_mutasi);
                                                $dateformat = date('D', $time);
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
                                                $formatbulan = date('F', $time);
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
                                                echo $nama_hari, ", ", date('d', $time), " ", $nama_bulan, " ", date('Y', $time);
                                                ?></td>
                                                <td><?= ucfirst($d->status_mutasi) ?></td>
                                            <td>
                                                <a onclick="return confirm('apakah anda yakin ingin menghapus riwayat data mutasi ini?')" href="<?= base_url('admin/hapus_mutasi/' . $d->no_urut) ?>" class="btn btn-sm btn-danger btn-sm"><span class="fa fa-trash"></span>
                                                </a>
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