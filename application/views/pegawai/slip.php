<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Jika ingin mencetak Slip, gunakan tombol download di pojok kiri bawah
            </div>

 
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img style="width: 50px" src="<?=base_url('assets/img/'.$web->logo)?>"> <?=$web->nama?>
                    <small class="float-right">Date :  <?=$this->M_data->hari(date('D')).', '.$this->M_data->tgl_indo(date('Y-m-d'));?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong><?=$web->nama?></strong><br>
                    <?=$web->alamat?><br>
                    Phone: <?=$web->nohp?><br>
                    Email: <?=$web->email?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?=ucwords($data->nama)?></strong><br>
                    Kode Pegawai : <?=$data->kode_pegawai?><br>
                    Email: <?=$data->email?><br>
                    Departemen : <?=$data->departemen?><br>
                    Gaji perhari : Rp. <?=number_format($data->gaji)?>
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                      <tr>
                        <th style="width:50%">Jumlah Kehadiran :</th>
                        <td><?=$absen?> hari x  Rp. <?=number_format($data->gaji)?></td>
                      </tr>
                      <tr>
                        <th>Jumlah Cuti :</th>
                        <td><?=$cuti?> hari x Rp. <?=number_format($data->gaji)?></td>
                      </tr>
                      <tr>
                        <th>Jumlah Sakit :</th>
                        <td><?=$sakit?> hari x Rp. <?=number_format($data->gaji)?></td>
                      </tr>
                      <tr>
                        <th>Jumlah Izin Tidak Masuk :</th>
                        <td><?=$izin?> hari x Rp. <?=number_format(0)?></td>
                      </tr>
                      <tr>
                        <th>Total :</th>
                        <td>Rp. <?=number_format(($absen * $data->gaji) + ($cuti * $data->gaji) + ($sakit * $data->gaji))?></td>
                      </tr>
                    </table>
                </div>
                <!-- /.col -->
              </div>

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?=base_url('pegawai/print_slip')?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>