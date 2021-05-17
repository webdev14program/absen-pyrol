          
          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-12 mb-6">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header ">
                  <div class="row">
                    <div class="col-md-6">
                      <h6 class="m-0 font-weight-bold text-primary"><?=$title?></h6>
                    </div>
                  </div>
                </div>
                <form method="post" action="<?=base_url('admin/profile_update/'.$this->session->userdata('user_id'))?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required="" value="<?=$data->nama?>">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required="" value="<?=$data->email?>">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="<?=base_url('admin')?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
          </div>