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
                        <form method="post" action="<?= base_url('admin/pengangkatan_update/' . $pengangkatan->id_pengangkatan_pegawai) ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode Pegawai</label>
                                    <input type="text" name="pilihpegawai" value="<?= $data->nama ?>" id="pilihpegawai" class="form-control" required="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Status Pegawai</label>
                                    <input type="text" name="statuspegawai" value="<?= $data->ket_status_pegawai ?>" id="statuspegawai" class="form-control" required="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <input type="text" name="departemen" id="departemen" value="<?= $data->departemen ?>" class="form-control" required="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" value="<?= $data->nama_jabatan ?>" class="form-control" required="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pengangkatan Pegawai</label>
                                    <input type="date" name="tanggalpengangkatan" value="<?= $pengangkatan->tanggal_pengangkatan ?>" class="form-control" required="">
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('admin/pengangkatan') ?>" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- <script>
        function check() {
            if (document.getElementById("pilihpegawai") != '') {
                var xhttps = new XMLHttpRequest();
                xhttps.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);
                        var jabatan = data["id_jabatan"];
                        var departemen = data["id_departemen"];
                        var status_pegawai = data["id_status_pegawai"];
                        document.getElementById("statuspegawai").value = status_pegawai;
                        document.getElementById("departemen").value = departemen;
                        document.getElementById("jabatan").value = jabatan;
                    }
                }
                var location = "../get/getisi/";
                var isi = document.getElementById("pilihpegawai").value.split(" ");
                xhttps.open('POST', location, true);

                xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttps.send("id=" + isi[0]);

            }
        }
    </script>
    <script type="text/javascript">
        $('#pilihpegawai').select2({
            placeholder: "Pilih Nama Pegawai...",
            allowClear: true
        });
    </script> -->