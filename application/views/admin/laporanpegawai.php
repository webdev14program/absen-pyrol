
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
            <select name="selectdepartemen" class="form-inline" id="departemen" style="width:200px">
              <option value="" selected="" disabled="">Pilih Departemen..</option>
              <?php foreach ($departemen as $d) { ?>
                <option value="<?= $d->departemen_id ?>"><?= $d->departemen ?></option>
              <?php } ?>
            </select>
            <button type="button" id="cari" class="btn btn-primary">Cari</button>
          </div>
          <div class="card-body table-responsive">
            <table border="1" id="myTable" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Pegawai</th>
                    <th>Jenis Kelamin</th>
                    <th>Departemen</th>
                    <th>Tanggal Masuk</th>
                    <th>Jabatan</th>
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
    $('#departemen').select2({
        placeholder: "Pilih Departemen...",
        allowClear: true
    });


    $('#cari').click(function(){
      var departemen = $('#departemen').val();
        $('#myTable').DataTable();
      if(departemen != ''){
        $.ajax({
            url:"<?php echo base_url(); ?>admin/json2",
            method:"POST",
            data: {selectdepartemen:departemen},
            dataType:"JSON",
            success:function (data) {
              // //header
              // $("#myTable").html("<thead><tr><th>No</th><th>Nama Pegawai</th><th>Gaji Pegawai</th><th>Pinjaman</th><th>Uang Makan</th><th>Uang Perjalanan Dinas</th><th>Uang Lembur</th></tr></thead><tbody>");
              var tabel = $('#myTable').DataTable();
              tabel.clear().draw();
              $.each( data, function(i) {
                tabel.row.add([(i+1).toString(),
                  data[i].kodepegawai,
                  data[i].jeniskelamin,
                  data[i].departemen,
                  data[i].tglmasuk,
                  data[i].jabatan]).draw(false);
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
