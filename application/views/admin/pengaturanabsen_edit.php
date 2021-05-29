<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="col">

            <section class="col-lg-12 connectedSortable">

                <!-- Map card -->
                <div class="card">
                    <div class="card-header"> <?= $title ?> </h3>
                    </div>
                    <form method="post" action="<?= base_url('admin/pengaturanabsen_update/' . $pengaturanabsen->no_urut) ?>"">
                        <div class="card-body">
                            <div class="form-inline">
                              <label>Set Jam Absen</label>&nbsp;
                              <div class="form-horizontal " style="margin-left:20px">
                                <label style="margin-right:150px">Jam Masuk</label><br>
                                <input type="time" name="jammasukawal" value="<?= $data->awal_jam_masuk ?>" class="form-inline" style="width:200px"><br>
                                <input type="time" name="jammasukakhir" value="<?= $data->akhir_jam_masuk ?>" class="form-inline" style="width:200px"><br>
                                <label style="margin-right:150px">Jam Pulang</label><br>
                                <input type="time" name="jampulangawal" value="<?= $data->awal_jam_pulang ?>" class="form-inline" style="width:200px"><br>
                                <input type="time" name="jampulangakhir" value="<?= $data->akhir_jam_pulang ?>" class="form-inline" style="width:200px">
                              </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('admin/pengaturanabsen') ?>" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>
