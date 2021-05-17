    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?= $title ?> </h3>
              </div>
              <form method="post" action="<?= base_url('admin/pegawai_update/' . $detail->kode_pegawai) ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Pegawai</label>
                    <input type="text" name="kode_pegawai" value="<?= $detail->kode_pegawai ?>" class="form-control" required="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama" value="<?= $detail->nama ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" value="<?= $detail->nik ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" name="npwp" value="<?= $detail->npwp ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Nama Keluarga</label>
                    <input type="text" name="namakeluarga" value="<?= $detail->nama_keluarga ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>No. Telp Keluarga yang bisa dihubungi</label>
                    <input type="tel" name="notelp" value="<?= $detail->no_telepon ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" onchange="ubahstatus()" class="form-control" required="">
                      <option value="">Pilih Status..</option>
                      <option <?php if ($detail->status == "single") echo 'selected'; ?> value="single">Single</option>
                      <option <?php if ($detail->status == "menikah") echo 'selected'; ?> value="menikah">Menikah</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label id="lbljumlahanak" disabled>Jumlah Anak</label>
                    <input type="number" onchange="ubahinput()" value="<?= $detail->jumlah_anak ?>" name="jmlanak" class="form-control" id="jumlahanak" required="" disabled>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <br>
                    <textarea name="alamat" class="form-control" required=""><?= $detail->alamat ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $detail->email ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                      <option value="" selected="" disabled="">Pilih Jenis Kelamin..</option>
                      <option <?php if ($detail->jenis_kelamin == 'L') {
                                echo 'selected';
                              } ?> value="L">Laki-Laki</option>
                      <option <?php if ($detail->jenis_kelamin == 'P') {
                                echo 'selected';
                              } ?> value="P">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Pegawai</label>
                    <select name="status_pegawai" class="form-control" id="status_pegawai">
                      <option value="">Pilih Status..</option>
                      <?php foreach ($status as $row) { ?>
                        <option <?php if ($detail->id_status_pegawai == $row->id_status_pegawai) echo "selected"; ?> value="<?= $row->id_status_pegawai ?>"><?= $row->ket_status_pegawai ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Departemen</label>
                    <select name="departemen" class="form-control">
                      <option value="" selected="" disabled="">Pilih Departemen..</option>
                      <?php foreach ($departemen as $d) { ?>
                        <option <?php if ($detail->id_departemen == $d->departemen_id) {
                                  echo "selected";
                                } ?> value="<?= $d->departemen_id ?>"><?= $d->departemen ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control">
                      <option value="" selected="" disabled="">Pilih Jabatan..</option>
                      <?php foreach ($jabatan as $e) { ?>
                        <option <?php if ($detail->id_jabatan == $e->id_jabatan) {
                                  echo "selected";
                                } ?> value="<?= $e->id_jabatan ?>"><?= $e->nama_jabatan ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>No. Kartu BPJS Kesehatan</label>
                    <input type="number" name="nokartubpjskesehatan" value="<?= $detail->no_kartu_bpjs_kesehatan ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>No. Kartu BPJS Tenaga Kerja</label>
                    <input type="number" name="nokartubpjstenagakerja" value="<?= $detail->no_kartu_bpjs_tenagakerja ?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                      <option value="" selected="" disabled="">Pilih Level..</option>
                      <option <?php if ($detail->level == 'pegawai') echo "selected"; ?> value="pegawai">Pegawai</option>
                      <option <?php if ($detail->level == 'manajer') echo "selected"; ?> value="manajer">Manajer</option>
                      <option <?php if ($detail->level == 'admin') echo "selected"; ?> value="admin">Admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Waktu masuk</label>
                    <input type="date" name="masuk" value="<?= $detail->waktu_masuk ?>" class="form-control" required="">
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
          document.getElementById("lbljumlahanak").disabled = false;
          document.getElementById("jumlahanak").disabled = false;
        } else {
          document.getElementById("lbljumlahanak").disabled = true;
          document.getElementById("jumlahanak").disabled = true;
          document.getElementById("jumlahanak").value = 0;
        }
      }

      function ubahinput() {
        var z = document.getElementById("status").selected = "menikah";
        if (z === true) {
          document.getElementById("lbljumlahanak").disabled = false;
          document.getElementById("jumlahanak").disabled = false;
        } else {
          document.getElementById("lbljumlahanak").disabled = true;
          document.getElementById("jumlahanak").disabled = true;
          document.getElementById("jumlahanak").value = 0;
        }
      }
    </script>