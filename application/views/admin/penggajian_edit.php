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
                    <form method="post" action="<?= base_url('admin/penggajian_update/' . $detail->kode_pegawai) ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <select name="namapegawai" class="pilihpegawai form-control" required="">
                                    <option value=""></option>
                                    <?php foreach ($pegawai as $key) { ?>
                                        <option <?php if ($detail->kode_pegawai == $key->kode_pegawai) echo "selected"; ?> value="<?= $key->kode_pegawai ?>"><?= $key->kode_pegawai ?> - <?= $key->nama ?> - <?= $key->nama_jabatan ?> - <?= $key->departemen ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Jumlah Kehadiran</label>
                              <input type="number" name="jumlahkehadiran" value="" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>Jumlah Lembur</label>
                              <input type="number" name="jumlahlembur" value="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Gaji Pokok</label>
                                <input type="text" name="gajipokok" id="gajipokok" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>Tunjangan</label>
                                <input type="text" name="tunjangan" id="tunjangan" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>Pinjaman</label><br>
                              <button type="button" name="modal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
                            </div>
                            <div class="form-group">
                                <label>Uang Makan</label>
                                <input type="text" name="uangmakan" id="uangmakan" class="form-control col-5" required=""/>
                            </div>
                            <div class="form-group">
                              <label>Insentif</label>
                              <input type="text" name="insentif" id="insentif" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>BPJS Kesehatan</label>
                              <input type="text" name="kesehatan" id="kesehatan" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>BPJS Tenaga Kerja</label>
                              <input type="text" name="tenagakerja" id="tenagakerja" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>Vaksin</label>
                              <input type="text" name="vaksin" id="vaksin" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>Sanksi</label>
                              <input type="text" name="sanksi" id="sanksi" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>THP</label>
                              <input type="text" name="thp" id="thp" class="form-control" required="">
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('admin/penggajian') ?>" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Pinjaman</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <label>Persenan</label>
                      <input type="int" name="persenan" class="form-control" required="">
                      <label>Jumlah Pinjaman</label>
                      <input type="text" name="pinjaman" id="pinjaman" value="" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </section>
        </div>
    </div>
</section>
<script>
    var gajipokok = document.getElementById('gajipokok');
    gajipokok.addEventListener('keyup', function(e) {
        gajipokok.value = formatRupiah(this.value, 'Rp. ');
    });

    var tunjangan = document.getElementById('tunjangan');
    tunjangan.addEventListener('keyup', function(e) {
        tunjangan.value = formatRupiah(this.value, "Rp. ");
    });

    var uangmakan = document.getElementById('uangmakan');
    uangmakan.addEventListener('keyup', function(e) {
        uangmakan.value = formatRupiah(this.value, "Rp. ");
    });

    var insentif = document.getElementById('insentif');
    insentif.addEventListener('keyup', function(e) {
        insentif.value = formatRupiah(this.value, "Rp. ");
    });

    var kesehatan = document.getElementById('kesehatan');
    kesehatan.addEventListener('keyup', function(e) {
        kesehatan.value = formatRupiah(this.value, "Rp. ");
    });

    var tenagakerja = document.getElementById('tenagakerja');
    tenagakerja.addEventListener('keyup', function(e) {
        tenagakerja.value = formatRupiah(this.value, "Rp. ");
    });

    var vaksin = document.getElementById('vaksin');
    vaksin.addEventListener('keyup', function(e) {
        vaksin.value = formatRupiah(this.value, "Rp. ");
    });

    var sanksi = document.getElementById('sanksi');
    sanksi.addEventListener('keyup', function(e) {
        sanksi.value = formatRupiah(this.value, "Rp. ");
    });

    var thp = document.getElementById('thp');
    thp.addEventListener('keyup', function(e) {
        thp.value = formatRupiah(this.value, "Rp. ");
    });

    var pinjaman = document.getElementById('pinjaman');
    pinjaman.addEventListener('keyup', function(e) {
        pinjaman.value = formatRupiah(this.value, "Rp. ");
    });





    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }



    $('.pilihpegawai').select2({
        placeholder: "Pilih Nama Pegawai...",
        allowClear: true,
    });
</script>
