    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">
                    <form method="post" action="<?= base_url('pegawai/perjalanandinas_simpan') ?>" enctype="multipart/form-data">
                        <!-- Map card -->
                        <div class="card">
                            <div class="card-header"> <?= $title ?> </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>No Surat Dinas</label>
                                    <input type="number" class="form-control" name="nosuratdinas" required="">
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" id="jabatan" class="form-control" name="jabatan" required="" value="<?= $data->nama_jabatan ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Mulai Perjalanan Dinas</label>
                                    <input type="date" name="tanggalmulai" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label>Selesai Perjalanan Dinas</label>
                                    <input type="date" name="tanggalakhir" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan Perjalanan Dinas</label>
                                    <textarea class="form-control" required="" name="ketperjalanandinas"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('pegawai/perjalanandinas') ?>" class="btn btn-danger">Kembali</a>
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            
        });

    </script>