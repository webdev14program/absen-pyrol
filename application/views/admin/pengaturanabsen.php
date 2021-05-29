<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

            <section class="col-lg-12 connectedSortable">

                <!-- Map card -->
                <div class="card">
                    <div class="card-header"> <?= $title ?> </h3>
                        <a style="float: right;" href="<?= base_url('admin/pengaturanabsen_add') ?>" class="btn btn-sm btn-primary">Tambah data</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="myTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <th>No</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Opsi</th>
                            </thead>
                            <tbody>
                              <?php $no = 1;
                              foreach ($pengaturanabsen as $d) { ?>
                              <tr>
                                <td width="1%"><?= $no++ ?></td>
                                <td>
                                  <?php
                                  $timeawalmasuk=strtotime($d->awal_jam_masuk);
                                  $timeakhirmasuk=strtotime($d->akhir_jam_masuk);
                                  $timeformatawalmasuk = date('H',$timeawalmasuk);
                                  $timeformatakhirmasuk = date('H',$timeakhirmasuk);
                                  if($timeformatawalmasuk >= "01" && $timeformatawalmasuk <= "11"){
                                    $ket = "Pagi";
                                  }
                                  else if($timeformatawalmasuk >= "12" && $timeformatawalmasuk <= "15"){
                                      $ket = "Siang";
                                  }else if($timeformatawalmasuk >="16" && $timeformatawalmasuk <= "18"){
                                        $ket = "Sore";
                                  }else{
                                    $ket = "Malam";
                                  }
                                  if($timeformatakhirmasuk >= "01" && $timeformatakhirmasuk <= "11"){
                                    $ket = "Pagi";
                                  }
                                  else if($timeformatakhirmasuk >= "12" && $timeformatakhirmasuk <= "15"){
                                      $ket = "Siang";
                                  }else if($timeformatakhirmasuk >="16" && $timeformatakhirmasuk <= "18"){
                                        $ket = "Sore";
                                  }else{
                                    $ket = "Malam";
                                  }
                                  echo date('h:i',$timeawalmasuk)," ",$ket," - ",date('h:i',$timeakhirmasuk)," ",$ket;
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  $timeawalmasuk=strtotime($d->awal_jam_pulang);
                                  $timeakhirmasuk=strtotime($d->akhir_jam_pulang);
                                  $timeformatawalmasuk = date('H',$timeawalmasuk);
                                  $timeformatakhirmasuk = date('H',$timeakhirmasuk);
                                  if($timeformatawalmasuk >= "01" && $timeformatawalmasuk <= "11"){
                                    $ket = "Pagi";
                                  }
                                  else if($timeformatawalmasuk >= "12" && $timeformatawalmasuk <= "15"){
                                      $ket = "Siang";
                                  }else if($timeformatawalmasuk >="16" && $timeformatawalmasuk <= "18"){
                                        $ket = "Sore";
                                  }else{
                                    $ket = "Malam";
                                  }
                                  if($timeformatakhirmasuk >= "01" && $timeformatakhirmasuk <= "11"){
                                    $ket = "Pagi";
                                  }
                                  else if($timeformatakhirmasuk >= "12" && $timeformatakhirmasuk <= "15"){
                                      $ket = "Siang";
                                  }else if($timeformatakhirmasuk >="16" && $timeformatakhirmasuk <= "18"){
                                        $ket = "Sore";
                                  }else{
                                    $ket = "Malam";
                                  }
                                  echo date('h:i',$timeawalmasuk)," ",$ket," - ",date('h:i',$timeakhirmasuk)," ",$ket;
                                  ?>
                                </td>
                                <td>
                                  <a href="<?= base_url('admin/pengaturanabsen_edit/' . $d->no_urut) ?>" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                  <a onclick="return confirm('apakah anda yakin ingin menghapus set jam absen ini?')" href="<?= base_url('admin/pengaturanabsen_delete/' . $d->no_urut) ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                </td>
                              </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
