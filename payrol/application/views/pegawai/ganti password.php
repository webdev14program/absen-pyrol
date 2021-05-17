          
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
                <form method="post" action="<?=base_url('pegawai/password_update/'.$this->session->userdata('nip'))?>">
                <div class="card-body">
                  <div class="form-group">
                    <input type="password" name="pw_lama" class="form-control" required="" placeholder="Masukan Password lama anda">
                  </div>
                  <div class="form-group">
                    <input type="password" name="pw_baru" class="form-control" required="" placeholder="Masukan Password baru anda">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="<?=base_url('pegawai')?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
          </div>