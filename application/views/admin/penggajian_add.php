<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<section class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">

      <section class="col-lg-12 connectedSortable">

        <!-- Map card -->
        <div class="card">
          <div class="card-header"> <?= $title ?> </h3>
          </div>
          <form method="post" action="<?= base_url('admin/simpan_penggajian_add') ?>" enctype="multipart/form-data">
            <div class="card-body">

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>ID Pegawai</label>
                    <input type="text" name="kode_pegawai" id="kode_pegawai" value="<?= $pegawai['kode_pegawai'] ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="namapegawai" value="<?= $pegawai['nama'] ?>" class="form-control" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Jumlah Kehadiran</label>
                    <input type="number" name="jumlahkehadiran" value="<?= $jumlah_hadir['jum_hadir'] ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Jumlah Lembur</label>
                    <input type="number" name="jumlahlembur" value="<?= $lembur['lembur'] ?>" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Gaji Pokok</label>
                    <input type="number" name="gajipokok" id="gajipokok" class="form-control">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Tunjangan</label>
                    <input type="number" name="tunjangan" id="tunjangan" class="form-control">
                  </div>
                </div>
              </div>


              <!-- <div class="form-group">
                <label>Pinjaman</label><br>
                <button type="button" name="modal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
              </div> -->
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Uang Makan</label>
                    <input type="number" name="uangmakan" id="uangmakan" class="form-control" />
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Insentif</label>
                    <input type="number" name="insentif" id="insentif" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>BPJS Kesehatan</label>
                <input type="number" name="kesehatan" id="kesehatan" class="form-control">
              </div>
              <div class="form-group">
                <label>BPJS Tenaga Kerja</label>
                <input type="number" name="tenagakerja" id="tenagakerja" class="form-control">
              </div>
              <div class="form-group">
                <label>Vaksin</label>
                <input type="number" name="vaksin" id="vaksin" class="form-control">
              </div>
              <div class="form-group">
                <label>Sanksi</label>
                <input type="number" name="sanksi" id="sanksi" class="form-control">
              </div>
              <div class="form-group">
                <label>THP</label>
                <input type="number" name="thp" id="thp" class="form-control">
              </div>
            </div>
            <div class="card-footer">
              <a href="<?= base_url('admin/penggajian') ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </section>
    </div>
  </div>
</section>
<script>
  // var gajipokok = document.getElementById('gajipokok');
  // gajipokok.addEventListener('keyup', function(e) {
  //   gajipokok.value = formatRupiah(this.value, 'Rp. ');
  // });
  //
  // var tunjangan = document.getElementById('tunjangan');
  // tunjangan.addEventListener('keyup', function(e) {
  //   tunjangan.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var uangmakan = document.getElementById('uangmakan');
  // uangmakan.addEventListener('keyup', function(e) {
  //   uangmakan.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var insentif = document.getElementById('insentif');
  // insentif.addEventListener('keyup', function(e) {
  //   insentif.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var kesehatan = document.getElementById('kesehatan');
  // kesehatan.addEventListener('keyup', function(e) {
  //   kesehatan.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var tenagakerja = document.getElementById('tenagakerja');
  // tenagakerja.addEventListener('keyup', function(e) {
  //   tenagakerja.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var vaksin = document.getElementById('vaksin');
  // vaksin.addEventListener('keyup', function(e) {
  //   vaksin.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var sanksi = document.getElementById('sanksi');
  // sanksi.addEventListener('keyup', function(e) {
  //   sanksi.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var thp = document.getElementById('thp');
  // thp.addEventListener('keyup', function(e) {
  //   thp.value = formatRupiah(this.value, "Rp. ");
  // });
  //
  // var pinjaman = document.getElementById('pinjaman');
  // pinjaman.addEventListener('keyup', function(e) {
  //   pinjaman.value = formatRupiah(this.value, "Rp. ");
  // });





  /* Fungsi formatRupiah */
  // function formatRupiah(angka, prefix) {
  //   var number_string = angka.replace(/[^,\d]/g, '').toString(),
  //     split = number_string.split(','),
  //     sisa = split[0].length % 3,
  //     rupiah = split[0].substr(0, sisa),
  //     ribuan = split[0].substr(sisa).match(/\d{3}/gi);
  //
  //   // tambahkan titik jika yang di input sudah menjadi angka ribuan
  //   if (ribuan) {
  //     separator = sisa ? '.' : '';
  //     rupiah += separator + ribuan.join('.');
  //   }
  //
  //   rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  //   return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  // }



  // $('.pilihpegawai').select2({
  //   placeholder: "Pilih Nama Pegawai...",
  //   allowClear: true,
  // });
</script>
