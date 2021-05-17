    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?=$title?> </h3>
                <a style="float: right;" href="<?=base_url('admin/departemen_add')?>" class="btn btn-sm btn-primary">Tambah data</a>
              </div>
              <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table-striped text-center">
                  <thead>
                    <th width="1%">No</th>
                    <th>Departemen</th>
                    <th width="10%">Opsi</th>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($data as $d) { ?>
                    <tr>
                      <td width="1%"><?=$no++?></td>
                      <td><?=ucfirst($d->departemen)?></td>
                      <td>
                        <a href="<?=base_url('admin/departemen_edit/'.$d->departemen_id)?>" class="btn btn-sm btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                        <a onclick="return confirm('apakah anda yakin ingin menghapus departemen ini?')" href="<?=base_url('admin/departemen_delete/'.$d->departemen_id)?>" class="btn btn-sm btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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