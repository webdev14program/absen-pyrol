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
                        <form method="post" action="<?= base_url('admin/pekerjaan_simpan/') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <select name="namapegawai" class="pilihpegawai form-control" required="">
                                        <option value=""></option>
                                        <?php foreach ($pegawai as $key) { ?>
                                            <option value="<?= $key->kode_pegawai ?>"><?= $key->kode_pegawai ?> - <?= $key->nama ?> - <?= $key->nama_jabatan ?> - <?= $key->departemen ?></option>
                                        <?php } ?>
                                    </select>
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
                                    <label>Uang Makan</label>
                                    <input type="text" name="uangmakan" id="uangmakan" class="form-control col-5" required=""/>

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
                                        <?php foreach ($jabatan as $e) { ?>
                                            <option value="<?= $e->id_jabatan ?>"><?= $e->nama_jabatan ?></option>
                                        <?php } ?>
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
        var gajipokok = document.getElementById('gajipokok');
        gajipokok.addEventListener('keyup', function(e) {
            gajipokok.value = formatRupiah(this.value, 'Rp. ');
        });

        var tunjangan = document.getElementById('tunjangan');
        tunjangan.addEventListener('keyup', function(e) {
            tunjangan.value = formatRupiah(this.value, "Rp. ");
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