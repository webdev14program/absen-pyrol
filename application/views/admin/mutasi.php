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
                    <form method="post" action="<?= base_url('admin/mutasi_simpan/') ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <select name="pegawai" oninvalid="InvalidNamaPegawai(this);" oninput="InvalidNamaPegawai(this);" id="pilihpegawai" class="form-control" required="required" onchange="ubahjenis()">
                                    <option value=""></option>
                                    <?php foreach ($pegawai as $b) { ?>
                                        <option value="<?= $b->kode_pegawai ?>"><?= $b->kode_pegawai ?> - <?= $b->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Mutasi</label>
                                <select name="jenismutasi" id="jenis" onchange="ubahjenis()" oninvalid="InvalidJenisMutasi(this);" oninput="InvalidJenisMutasi(this);" class="form-control" required="required">
                                    <option value="">Pilih Jenis Mutasi..</option>
                                    <option value="promosi">Promosi</option>
                                    <option value="mutasi">Mutasi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="lbljabatan" disabled>Jabatan</label>
                                <select name="jabatan" id="jabatan" oninvalid="InvalidJenisJabatan(this);" oninput="InvalidJenisJabatan(this);" class="form-control" required="required" disabled>
                                    <option value="">Pilih Jabatan..</option>
                                    <?php foreach ($jabatan as $key) { ?>
                                        <option value="<?= $key->id_jabatan ?>"><?= $key->nama_jabatan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="lbldepartemen" disabled>Departemen</label>
                                <select name="departemen" id="departemen" oninvalid="InvalidJenisDepartemen(this);" oninput="InvalidJenisDepartemen(this);" class="form-control" required="required" disabled>
                                    <option value="">Pilih Departemen..</option>
                                    <?php foreach ($departemen as $key) { ?>
                                        <option value="<?= $key->departemen_id ?>"><?= $key->departemen ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mutasi</label>
                                <input type="date" name="tanggalmutasi" oninvalid="InvalidTanggal(this);" oninput="InvalidTanggal(this);" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>No. SK</label>
                                <input type="file" name="filenosk" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('admin/') ?>" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>
<script>
    function InvalidNamaPegawai(nm) {
        if (nm.value === '') {
            nm.setCustomValidity('Silahkan pilih nama pegawai !');
        } else {
            nm.setCustomValidity('');
        }
        return true;
    }

    function InvalidJenisMutasi(js) {
        if (js.value === '') {
            js.setCustomValidity('Silahkan pilih jenis mutasi !');
        } else {
            js.setCustomValidity('');
        }
    }

    function InvalidJenisJabatan(level) {
        if (level.value === '') {
            level.setCustomValidity('Silahkan pilih jabatan !');
        } else {
            level.setCustomValidity('');
        }
    }

    function InvalidJenisDepartemen(level) {
        if (level.value === '') {
            level.setCustomValidity('Silahkan pilih departemen !');
        } else {
            level.setCustomValidity('');
        }
    }

    function InvalidTanggal(tgl) {
        if (tgl.value === '') {
            tgl.setCustomValidity('Silahkan pilih tanggal mutasi !');
        } else if (tgl.validity.typeMismatch) {
            tgl.setCustomValidity('Masukkan format tanggal dengan benar !');
        } else {
            tgl.setCustomValidity('');
        }
    }

    function InvalidNoSK(no) {
        if (no.value === '') {
            no.setCustomValidity('Silahkan upload no sk dengan benar !');
        } else {
            no.setCustomValidity('');
        }
    }

    function ubahjenis() {
        var x = document.getElementById("jenis").value;
        document.getElementById("jabatan").selectedIndex = 0;
        document.getElementById("departemen").selectedIndex = 0;
        document.getElementById("jabatan").disabled = true;
        document.getElementById("departemen").disabled = true;
        checkMutasiDepartemen();
        if (x == 'promosi') {
            document.getElementById("jabatan").disabled = false;
            document.getElementById("departemen").disabled = true;

        } else if (x == 'mutasi') {
            document.getElementById("jabatan").disabled = true;
            document.getElementById("departemen").disabled = false;
            // checkMutasiDepartemen("mutasi");
        }
    }

    $(document).ready(function() {
        $('#jabatan').change(function() {

        });
    });


    function checkMutasiDepartemen() {
        if (document.getElementById('pilihpegawai').value !== '' && document.getElementById('jenis').value !== '') {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    // if (jenis == "promosi") {
                    // alert(data["jab"]);
                    var index = 0;
                    var array = [<?php foreach ($jabatan as $key) {
                                        echo "'" . $key->nama_jabatan . "',";
                                    } ?> ''];
                    for (dat in array) {
                        index = index + 1;
                        if (array[dat] == data['jab']) {
                            break;
                        }
                        // alert(dat);
                        // alert(data['jab']);
                        if (array[dat] == '') {
                            index = 0;
                            break;
                        }
                    }
                    // alert(index);

                    document.getElementById("jabatan").selectedIndex = index;
                    // } else if (jenis = "mutasi") {
                    var index = 0;
                    var array = [<?php foreach ($departemen as $key) {
                                        echo "'" . $key->departemen . "',";
                                    } ?> ''];
                    for (dat in array) {
                        index = index + 1;
                        if (array[dat] == data['dept']) {
                            break;
                        }
                        // alert(dat);
                        // alert(data['jab']);
                        if (array[dat] == '') {
                            index = 0;
                            break;
                        }
                    }
                    document.getElementById("departemen").selectedIndex = index;
                }
                // alert("nana");
                // }
                // alert("s" + this.status + " " + this.readyState);
            }
            var location = "../get";
            var isi = document.getElementById("pilihpegawai").value.split(" ");
            // alert(window.location.href);
            xhttps.open('POST', location, true);
            xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttps.send("id=" + isi[0]);
            // alert(isi[0]);
        }
    }
</script>
<script type="text/javascript">
    $('#pilihpegawai').select2({
        placeholder: "Pilih Nama Pegawai...",
        allowClear: true
    });
</script>