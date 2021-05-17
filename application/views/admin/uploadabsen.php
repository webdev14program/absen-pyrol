    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">

                    <!-- Map card -->
                    <div class="card">
                        <div class="card-header"> <?= $title ?> </h3>
                        </div>
                        <form method="post" action="<?= base_url('admin/absen_simpan') ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="upload" required=""> 

                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('admin/absensi') ?>" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>