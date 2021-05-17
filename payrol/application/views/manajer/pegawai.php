    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">

                    <!-- Map card -->
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="myTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <th>No</th>
                                    <th>Kode Pegawai</th>
                                    <th>Nama</th>
                                    <th>jenis kelamin</th>
                                    <th>Jabatan</th>
                                    <th>Waktu Masuk</th>
                                    <th>Gaji</th>
                                    <th>Opsi</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data as $d) { ?>
                                        <tr>
                                            <td width="1%"><?= $no++ ?></td>
                                            <td><?= $d->kode_pegawai ?></td>
                                            <td><?= ucfirst($d->nama) ?></td>
                                            <td><?= $d->jenis_kelamin ?></td>
                                            <td><?= ucfirst($d->departemen) ?></td>
                                            <td><?= $this->M_data->tgl_indo(date('Y-m-d'), strtotime($d->waktu_masuk)) ?></td>
                                            <td>Rp. <?= number_format($d->gaji) ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/pegawai_edit/' . $d->kode_pegawai) ?>" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                                <a onclick="return confirm('apakah anda yakin ingin menghapus pegawai ini?')" href="<?= base_url('admin/pegawai_delete/' . $d->kode_pegawai) ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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