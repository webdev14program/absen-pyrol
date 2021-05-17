<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/bootstrap/dist/css/bootstrap.min.css">
  <script src="<?php echo base_url(); ?>node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>node_modules/moment/min/moment-with-locales.min.js"></script>
  <script src="<?php echo base_url(); ?>node_modules/jquery-touchswipe/jquery.touchSwipe.min.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery-calendar.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-calendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/@fortawesome/fontawesome-free-webfonts/css/fontawesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/@fortawesome/fontawesome-free-webfonts/css/fa-solid.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/css/web2cal.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
  <script src="<?php echo base_url(); ?>plugins/js/Web2Cal-Basic-2.0-min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/js/web2cal.support.js"></script>
  <script src="<?php echo base_url(); ?>plugins/js/web2cal.default.template.js"></script> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>fullcalendar/fullcalendar.css">
</head>

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $pegawai ?></h3>

            <p>Jumlah Karyawan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?= base_url('admin/pegawai') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $hadir ?></h3>

            <p>Karyawan hadir hari ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?= base_url('admin/absensi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $izin ?></h3>

            <p>Jumlah Izin / Sakit Hari ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?= base_url('admin/absensi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $izin + $cuti ?></h3>

            <p>Karyawan Tidak Hadir</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

      <section class="col-lg-12 connectedSortable">

        <!-- Map card -->
        <div class="card">
          <div class="card-header"> Notifikasi </h3>
          </div>
          <form method="post" action="admin/proses_absen">
            <div class="card-body">
              <?php if ($waktu != 'dilarang') { ?>
                <p class="text-center">Hai, <?= $this->session->userdata('nama') ?> anda hari ini belum melakukan absen <b><?= $waktu ?></b>. Silahkan lakukan absen pada tombol absen berikut <br><br><button class="btn btn-primary">Absen <?= $waktu ?></button></p>
                <input type="hidden" name="ket" id="ket" value="<?= $waktu ?>">
              <?php } else { ?>
                <p class="text-center">Hai, <?= $this->session->userdata('nama') ?> anda hari ini sudah melakukan absensi <b>Masuk</b> dan <b>Pulang</b></p>
              <?php }  ?>
            </div>
          </form>
          <div class="card-body">
            Selamat datang <b><?= $this->session->userdata('nama') ?></b>, saat ini anda login menggunakan akun <b><?= $this->session->userdata('level') ?></b>.
          </div>
        </div>
      </section>
    </div>
  </div>
</section>

<div class="row">
  <section class="col-lg-10" style="margin-left:50px;margin-right:60px">
    <div class="card">
      <div id="calendar">

      </div>
    </div>
  </section>
</div>
<script src="<?php echo base_url(); ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url(); ?>fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url(); ?>fullcalendar/fullcalendar.js"></script>
<!-- <script type='module'>
  import {
    Calendar
  } from '@fullcalendar/core';
  import dayGridPlugin from '@fullcalendar/daygrid';
  import timeGridPlugin from '@fullcalendar/timegrid';
  import listPlugin from '@fullcalendar/list';
</script> -->
<script type="text/javascript">
  var calendar = $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month basicWeek basicDay listMonth'
    },
    selectable: true,
    selectHelper: true,
    defaultDate: moment().format('YYYY-MM-DD'),
    navLink: true,
    buttonText: {
      today: 'Hari Ini',
      month: 'Bulanan',
      week: 'Mingguan',
      day: 'Harian',
      list: 'List'
    },
    events: {
      url: '<?php echo base_url(); ?>fullcalendar/index/',
      color: 'green',
      textColor: 'white',
    },
    select: function(start, end, allDay) {
      var title = prompt("Masukkan title");
      if (title) {
        var ket = prompt("Masukkan ket");
        var start = moment(start).format('YYYY-MM-DD');
        var end = moment(end).format('YYYY-MM-DD');
        $.ajax({
          url: '<?php echo base_url(); ?>fullcalendar/kalender_add/',
          type: 'POST',
          data: {
            title: title,
            ket: ket,
            start: start,
            end: end
          },
          success: function() {
            calendar.fullCalendar('refetchEvents');
            alert("Berhasil Tambah");
          }
        })
      }
    },
    editable: true,
    eventResize: function(event) {
      var start = moment(event.start).format('YYYY-MM-DD');
      var end = moment(event.end).format('YYYY-MM-DD');
      var title = event.title;
      var ket = event.ket;

      var id = event.id;

      $.ajax({
        url: '<?php echo site_url(); ?>fullcalendar/kalender_update/',
        type: 'POST',
        data: {
          title: title,
          ket: ket,
          start: start,
          end: end,
          id: id
        },
        success: function() {
          calendar.fullCalendar('refetchEvents');
          alert("Berhasil Ubah");
        }
      });
    },
    eventDrop: function(event) {
      var start = moment(event.start).format('YYYY-MM-DD');
      var end = moment(event.end).format('YYYY-MM-DD');
      var title = event.title;
      var ket = event.ket;

      var id = event.id;

      $.ajax({
        url: '<?php echo site_url(); ?>fullcalendar/kalender_update/',
        type: 'POST',
        data: {
          title: title,
          ket: ket,
          start: start,
          end: end,
          id: id
        },
        success: function() {
          calendar.fullCalendar('refetchEvents');
          alert("Berhasil Ubah");
        }
      });
    },
    eventClick: function(event) {
      var id = event.id;
      if (confirm("Apakah anda ingin menghapusnya ?")) {
        $.ajax({
          url: '<?php echo base_url(); ?>fullcalendar/kalender_delete/',
          type: 'POST',
          data: {
            id: id
          },
          success: function() {
            calendar.fullCalendar('refetchEvents');
            alert("Berhasil Hapus");
          }
        });
      } else {
        return false;
      }
    }

  });


  // document.addEventListener('DOMContentLoaded', function() {

  //   var calendarEl = document.getElementById('calendar');
  //   var calendar = new Calendar(calendarEl, {
  //     plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
  //     initialView: 'dayGridMonth',
  //     headerToolbar: {
  //       left: 'prev,next today',
  //       center: 'title',
  //       right: 'dayGridMonth,timeGridWeek,listWeek'
  //     }
  //   });
  //   calendar.render();
  // });
</script>
<!-- <script>
// $(document).ready(function() {
//   moment.locale('fr');
//   var now = moment();
//   $('#calendar').Calendar({
//   }).init();
// });
// jQuery(document).ready(function() {
//   iCal = new Web2Cal("calendar", {
//     loadEvents: function(startDate, endDate, viewName) {
//       /* Get events from any source. This can be a PHP/Java/.NET/Facebook or any other source. Once you have the data, invoke ical.render(data).*/
//       iCal.render();
//     },
//     onNewEvent: function(event, groups, allDay) {},
//     onUpdateEvent: function(event) {}
//   });
//   iCal.build();
// });
<
/script> 
-->