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
                    <form method="post" action="<?= base_url('manajer/perjalanandinas_simpan') ?>" enctype="multipart/form-data">
                        <!-- Map card -->
                        <div class="card">
                            <div class="card-header"> <?= $title ?> </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>No Surat Dinas</label>
                                    <input type="number" class="form-control" name="nosuratdinas" required="">
                                </div>
                                <div class="form-group">
                                    <table class="table table-bordered" id="isitabel">
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>Jabatan</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="namapegawai" id="pilihpegawai" class="form-control" required="" onchange="checknamajabatan()">
                                                    <option value=""></option>
                                                    <?php foreach ($pegawai as $data) { ?>
                                                        <option value="<?= $data->kode_pegawai ?>"><?= $data->kode_pegawai ?> - <?= $data->nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="jabatan" class="form-control" value="" required="">
                                            </td>
                                            <td>
                                                <input type="button" name="tambah" id="tambah" value="Tambah" class="form-control btn btn-success">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label>Mulai Perjalanan Dinas</label>
                                    <input type="date" name="tanggalmulai" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label>Selesai Perjalanan Dinas</label>
                                    <input type="date" name="tanggalakhir" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan Perjalanan Dinas</label>
                                    <textarea class="form-control" required="" name="ketperjalanandinas"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('manajer/perjalanandinas') ?>" class="btn btn-danger">Kembali</a>
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var html =
                '<tr>' +
                '<td>' +
                '<select name="namapegawai" id="pilihpegawai" class="form-control" required="">' +
                '<option value=""></option>' +
                <?php foreach ($pegawai as $key) { ?> '<option value="<?php echo $key->kode_pegawai ?>"><?php echo $key->kode_pegawai ?> - <?php echo $key->nama ?></option>' +
                <?php } ?> '</select>' +
                '</td>' +
                '<td>' +
                '<input type="text" name="jabatan" class="form-control" required="">' +
                '</td>' +
                '<td>' +
                '<input type="button" name="hapus" id="hapus" value="Hapus" class="form-control btn btn-danger" required="">' +
                '</td>' +
                '</tr>';

            var x = 1;
            $('#tambah').click(function() {
                $('#isitabel').append(html);
            });
            $('#isitabel').on('click', '#hapus', function() {
                $(this).closest('tr').remove();
            });
        });

        $(document).ready(function() {

        }); 




        $('#pilihpegawai').select2({
            placeholder: "Pilih Nama Pegawai...",
            allowClear: true
        });
    </script>