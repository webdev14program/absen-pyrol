
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
          <div class="card-header"> <?=$title?> </h3>
          </div>
          <div class="card-body">
            <span>
              <select name="birth_month" id="month" class="form-inline" style="width:200px">
                <option value=""></option>
                <?php for( $m=1; $m<=12; ++$m ) {
                  $month_label = date('F', mktime(0, 0, 0, $m, 1));
                ?>
                  <option value="<?php echo $month_label; ?>"><?php echo $month_label; ?></option>
                <?php } ?>
              </select>
            </span>
            <span>
              <select name="birth_year" id="year" style="width:200px">
                <option value=""></option>
                <?php
                  $year = date('Y');
                  $min = $year - 60;
                  $max = $year;
                  for( $i=$max; $i>=$min; $i-- ) {
                    echo '<option value='.$i.'>'.$i.'</option>';
                  }
                ?>
              </select>
            </span>
            <span>
              <button type="button" id="cari" class="btn btn-primary">Cari</button>
            </span>
          </div>
          <div class="card-body table-responsive">
            <table border="1" id="myTable" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Gaji Pegawai</th>
                    <th>Pinjaman</th>
                    <th>Uang Makan</th>
                    <th>Uang Perjalanan Dinas</th>
                    <th>Uang Lembur</th>
                  </tr>
                </thead>
                <tbody id="hasildata">
                </tbody>
              </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>
<script type="text/javascript">
    $('#month').select2({
        placeholder: "Pilih Bulan...",
        allowClear: true
    });$('#year').select2({
        placeholder: "Pilih Tahun...",
        allowClear: true
    });
    $('#cari').click(function(){
      var bulan = $('#month').val();
      var tahun = $('#year').val();
      if(bulan != '' && tahun != ''){
        $.ajax({

        })
      }else{

      }
    });

</script>
