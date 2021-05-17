    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?= $title ?> </h3>
              </div>
              <form method="post" action="<?= base_url('admin/pegawai_simpan/') ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Pegawai</label>
                    <input type="text" name="kode_pegawai" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" name="npwp" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Nama Keluarga</label>
                    <input type="text" name="namakeluarga" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>No. Telp Keluarga yang bisa dihubungi</label>
                    <input type="tel" name="notelp" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" onchange="ubahstatus()" class="form-control" required="">
                      <option value="">Pilih Status..</option>
                      <option value="single">Single</option>
                      <option value="menikah">Menikah</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label id="lbljumlahanak" disabled>Jumlah Anak</label>
                    <input type="number" name="jmlanak" class="form-control" id="jumlahanak" required="" disabled>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <br>
                    <textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                      <option value="" selected="" disabled="">Pilih Jenis Kelamin..</option>
                      <option value="L">Laki-Laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Pegawai</label>
                    <select name="status_pegawai" class="form-control" id="status_pegawai">
                      <option value="">Pilih Status Pegawai..</option>
                      <?php foreach ($status as $row) { ?>
                        <option value="<?= $row->id_status_pegawai ?>"><?= $row->ket_status_pegawai ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Departemen</label>
                    <select name="departemen" class="form-control">
                      <option value="" selected="" disabled="">Pilih Departemen..</option>
                      <?php foreach ($departemen as $d) { ?>
                        <option value="<?= $d->departemen_id ?>"><?= $d->departemen ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control">
                        <option value="" selected="" disabled="">Pilih Jabatan..</option>
                        <?php foreach ($jabatan as $e) {?>
                          <option value="<?= $e->id_jabatan?>"><?= $e->nama_jabatan ?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>No. Kartu BPJS Kesehatan</label>
                    <input type="number" name="nokartubpjskesehatan" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>No. Kartu BPJS Tenaga Kerja</label>
                    <input type="number" name="nokartubpjstenagakerja" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                      <option value="" selected="" disabled="">Pilih Level..</option>
                      <option value="pegawai">Pegawai</option>
                      <option value="manajer">Manajer</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Waktu masuk</label>
                    <input type="date" name="masuk" class="form-control" required="">
                  </div>
                </div>
                <div class="card-footer">
                  <a href="<?= base_url('admin/pegawai') ?>" class="btn btn-danger">Kembali</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </section>
    <script>
      function ubahstatus() {
        var x = document.getElementById("status").value;
        if (x == 'menikah') {
          document.getElementById("jumlahanak").disabled = false;
          document.getElementById("jumlahanak").disabled = false;
        } else {
          document.getElementById("lbljumlahanak").disabled = true;
          document.getElementById("jumlahanak").disabled = true;
          document.getElementById("jumlahanak").value = 0;

        }
      }
    </script>