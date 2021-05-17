    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">

                    <!-- Map card -->
                    <div class="card">
                        <div class="card-header"> <?= $title ?> </h3>
                            <a style="float: right;" href="<?= base_url('admin/pengangkatan_add') ?>" class="btn btn-sm btn-primary">Tambah data</a>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="myTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Status Pegawai</th>
                                    <th>Departemen</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Pengangkatan Pegawai</th>
                                    <th>Opsi</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengangkatan as $d) { ?>
                                        <tr>
                                            <td width="1%"><?= $no++ ?></td>
                                            <td><?= ucfirst($d->nama) ?></td>
                                            <td><?= ucfirst($d->ket_status_pegawai) ?></td>
                                            <td><?= ucfirst($d->departemen) ?></td>
                                            <td><?= ucfirst($d->nama_jabatan) ?></td>
                                            <td><?php
                                                $time = strtotime($d->tanggal_pengangkatan);
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
                                                echo date('d', $time), " ", $nama_bulan, " ", date('Y', $time) ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/pengangkatan_edit/' . $d->id_pengangkatan_pegawai) ?>" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                                <a onclick="return confirm('apakah anda yakin ingin menghapus pegawai ini?')" href="<?= base_url('admin/pengangkatan_delete/' . $d->id_pengangkatan_pegawai) ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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