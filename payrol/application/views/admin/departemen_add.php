    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?= $title ?> </h3>
              </div>
              <form method="post" action="<?= base_url('admin/departemen_simpan') ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Departemen</label>
                    <input type="text" name="kodedepartemen" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Departemen</label>
                    <input type="text" name="departemen" class="form-control" required="">
                  </div>
                </div>
                <div class="card-footer">
                  <a href="<?= base_url('admin/departemen') ?>" class="btn btn-danger">Kembali</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </section>