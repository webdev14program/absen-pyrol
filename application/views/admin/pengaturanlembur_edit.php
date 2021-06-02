<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="col">

            <section class="col-lg-12 connectedSortable">

                <!-- Map card -->
                <div class="card">
                    <div class="card-header"> <?= $title ?> </h3>
                    </div>
                    <form method="post" action="<?= base_url('admin/pengaturanlembur_update/' . $pengaturanlembur->no_lembur) ?>"">
                        <div class="card-body">
                          <div class="row">
                             <div class="col">
                               <div class="form-group">
                                 <label>Set Jam Absen</label>
                                 <input type="time" name="awal" value="<?= $data->waktu_awal ?>" class="form-control" style="width:200px"><br>
                                 <input type="time" name="akhir" value="<?= $data->waktu_akhir ?>" class="form-control" style="width:200px">
                               </div>
                             </div>
                             <div class="col">
                               <div class="form-group">
                                 <label>Tipe Lembur</label>
                                 <select class="form-control" name="optiontipe" style="width:200px">
                                   <option value=""></option>
                                   <option <?php if($data->tipe_lembur == "masuk") echo "selected";?> value="masuk">Masuk</option>
                                   <option <?php if($data->tipe_lembur == "pulang") echo "selected";?>value="pulang">Pulang</option>
                                 </select>
                               </div>
                             </div>
                             <div class="col">
                               <div class="form-group">
                                 <label>Ket Lembur</label>
                                 <input type="text" name="ketlembur" value="<?= $data->ket_lembur ?>" class="form-control" style="width:200px">
                               </div>
                             </div>
                           </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('admin/pengaturanlembur') ?>" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>
