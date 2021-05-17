    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $pegawai ?></h3>

                            <p>Jumlah Karyawan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?= base_url('manajer/pegawai') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $hadir ?></h3>

                            <p>Karyawan hadir hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?= base_url('manajer/absensi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $izin ?></h3>

                            <p>Jumlah Izin / Sakit Hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= base_url('manajer/absensi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $izin + $cuti ?></h3>

                            <p>Karyawan Tidak Hadir</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">

                    <!-- Map card -->

                    <div class="card">
                        <div class="card-header"> Notifikasi </h3>
                        </div>
                        <form method="post" action="manajer/proses_absen">
                            <div class="card-body">
                                <?php if ($waktu != 'dilarang') { ?>
                                    <p class="text-center">Hai, <?= $this->session->userdata('nama') ?> anda hari ini belum melakukan absen <b><?= $waktu ?></b>. Silahkan lakukan absen pada tombol absen berikut <br><br><button class="btn btn-primary">Absen <?= $waktu ?></button></p>
                                    <input type="hidden" name="ket" id="ket" value="<?= $waktu ?>">
                                <?php } else { ?>
                                    <p class="text-center">Hai, <?= $this->session->userdata('nama') ?> anda hari ini sudah melakukan absensi <b>Masuk</b> dan <b>Pulang</b></p>
                                <?php }  ?>
                            </div>
                        </form>
                        <div class="card-body">
                            Selamat datang <b><?= $this->session->userdata('nama') ?></b>, saat ini anda login menggunakan akun <b><?= $this->session->userdata('level') ?></b>.
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>