<section class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">

      <section class="col-lg-6 connectedSortable">

        <!-- Map card -->
        <div class="card">
          <div class="card-header"> Notifikasi </h3>
          </div>
          <div class="card-body">
            <p align="center">Hai,&nbsp<b><?= $this->session->userdata('nama') ?></b>&nbsp silahkan mengambil kode untuk absensi</p>
            <p align="center"><button id="kode" class="btn btn-primary">Buka QR Code</button><img id="gambarkode" hidden></p>

          </div>
        </div>
      </section>

      <section class="col-lg-6 connectedSortable">

        <!-- Map card -->
        <div class="card">
          <div class="card-header"> Slip Gaji </h3>
          </div>
          <div class="card-body">

            <p class="text-center">Hai, <b><?= $this->session->userdata('nama') ?></b> silahkan download slip gaji anda pada tombol berikut <br><br><a class="btn btn-info" href="<?= base_url('pegawai/slip') ?>">Download Slip Gaji</a></p>
          </div>
        </div>
      </section>

    </div>
  </div>
</section>
<script>
  // document.getElementById('kode').addEventListener('click', function() {
  //   var element = document.createElement('img');
  //   var urlD = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=";
  //   element.setAttribute('src', urlD);
  //   appendChild(element);
  // })


  // var urlComplete = urlD + isi;
  // document.getElementById('gambarcode').src = urlComplete;
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
<script>
  //yo ini yang qr pegawai
  //dari sini ad yang salah, di bagian key mkony dk bs decrypt
  //buat fungsi get date hr ini, cuma tanggal  b, bulan dk sah, sm tahun jg, tpi sebenerny boleh b sih klo nk tanggl,bulan,tahun

  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  console.log(date);

  var isi = "<?= $kodepegawai ?>";
  console.log("isi kode pegawai :" + isi);
  //isi,key
  var enkripsitext = CryptoJS.AES.encrypt(isi, date);
  console.log(typeof(enkripsitext));
  console.log("enskripsi " + enkripsitext);
  var test1=enkripsitext.toString();
  console.log(typeof(test1));
//dari sini
  var dekripsitext = CryptoJS.AES.decrypt(enkripsitext.toString(), date);
  console.log("dekripsi " + dekripsitext);
  var hasildekripsi = dekripsitext.toString(CryptoJS.enc.Utf8);
  console.log("hasil decrypt " + hasildekripsi);
//sampe sini
  var urlD = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=";
  var urlComplete = urlD + enkripsitext;
  document.getElementById('gambarkode').src = urlComplete;
  // kode

  document.getElementById('kode').addEventListener("click", function() {
    if (document.getElementById("kode").hidden == true) {
      document.getElementById("kode").hidden = false;
      document.getElementById("gambarkode").hidden = true;
    } else {
      document.getElementById("kode").hidden = true;
      document.getElementById("gambarkode").hidden = false;
    }
  });
</script>
