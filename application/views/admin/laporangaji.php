
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
              <select name="selectbulan" id="month" class="form-inline" style="width:200px">
                <option value=""></option>
                <?php for( $m=1; $m<=12; ++$m ) {
                  $month_label = date('F', mktime(0, 0, 0, $m, 1));
                ?>
                  <option value="<?php echo $month_label; ?>"><?php echo $month_label; ?></option>
                <?php } ?>
              </select>
            </span>
            <span>
              <select name="selecttahun" id="year" style="width:200px">
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
                <tbody>
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
        $('#myTable').DataTable();
      if(bulan != '' && tahun != ''){
        $.ajax({
            url:"<?php echo base_url(); ?>admin/json",
            method:"POST",
            data:{selectbulan:bulan, selecttahun:tahun},
            dataType:"JSON",
            success:function (data) {
              // //header
              // $("#myTable").html("<thead><tr><th>No</th><th>Nama Pegawai</th><th>Gaji Pegawai</th><th>Pinjaman</th><th>Uang Makan</th><th>Uang Perjalanan Dinas</th><th>Uang Lembur</th></tr></thead><tbody>");
              var tabel = $('#myTable').DataTable();
              tabel.clear().draw();
              $.each( data, function(i) {
                tabel.row.add([(i+1).toString(),
                  data[i].kodepegawai,
                  data[i].gajipokok,
                  '',
                  data[i].uangmakan,
                  '',
                  '']).draw(false);
                //body
                // $("#myTable").html($("#myTable").html()+"<tr><td>"+(i+1)+"</td><td>"+data[i].kodepegawai+"</td><td>"+data[i].gajipokok+"</td><td></td><td>"+data[i].uangmakan+"</td><td></td><td></td></tr>");
                // alert("<tr><td>"+(i+1)+"</td><td>"+data[i].kodepegawai+"</td><td>"+data[i].gajipokok+"</td><td></td><td>"+data[i].uangmakan+"</td><td></td><td></td></tr>");
                // alert((i+1)+" ma"+ data[i].kodepegawai);
                // alert($("#hasildata").html());
                // alert(data[i].kodepegawai);
              });
              // //footer
              // $("#myTable").html($("#myTable").html()+"</tbody>");
              // $('#myTable').DataTable();
            }
        })
      }else{
        alert("Error");
      }
    });

</script>
