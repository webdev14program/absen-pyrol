          
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
                <form method="post" action="<?=base_url('pegawai/profile_update/'.$this->session->userdata('nip'))?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required="" value="<?=$data->nama?>">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required="" value="<?=$data->email?>">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                      <option value="" selected="" disabled="">Pilih Jenis Kelamin</option>
                      <option <?php if ($data->jenis_kelamin == 'L') {echo 'selected'; }?> value="L">Laki-Laki</option>
                      <option <?php if ($data->jenis_kelamin == 'P') {echo 'selected'; }?> value="P">Perempuan</option>
                    </select>
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