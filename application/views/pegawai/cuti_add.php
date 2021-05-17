    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">
            <form method="post" action="<?=base_url('pegawai/cuti_simpan')?>" enctype="multipart/form-data">
            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?=$title?> </h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Jenis Ketidakhadiran</label>
                  <select name="jenis" id="jenis" class="form-control" required="" onchange="myFunction()">
                    <option value="" selected="" disabled="">--Pilih--</option>
                    <?php if ($bakti > 365) { ?>
                      <option value="cuti">Cuti</option>
                    <?php } ?>
                    <option value="izin">Izin Tidak Masuk</option>
                    <option value="sakit">Izin Sakit</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Surat Keterangan Dokter</label>
                  <input type="file" name="bukti" id="bukti" class="form-control" disabled="">
                </div>
                <div class="form-group">
                  <label>Mulai Ketidakhadiran</label>
                  <input type="date" name="mulai" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label>Selesai Ketidakhadiran</label>
                  <input type="date" name="akhir" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label>Alasan Ketidakhadiran</label>
                  <textarea class="form-control" required="" name="alasan"></textarea>
                </div>
              </div>
              <div class="card-footer">
                <a href="<?=base_url('pegawai/cuti')?>" class="btn btn-danger">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
              </div>
            </div>
            </form>
          </section>
        </div>
      </div>
    </section>
    <script>
      function myFunction() {
        var x = document.getElementById("jenis").value;
        if (x == 'sakit') {
          document.getElementById("bukti").disabled = false;
        }
        else
        {
          document.getElementById("bukti").disabled = true;
        }
      }
    </script>