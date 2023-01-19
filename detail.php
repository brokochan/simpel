<?php 
include "koneksi.php"; 
$param = $_GET['kec'];
$kec = $koneksi->query("select count(*) as total from minat_investasi where id_kecamatan = $param");
$tkec = $kec->fetch_assoc();
$total = $tkec['total'];
?>
<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!--Theme Styles-->
    <link href="assets/css/dark-theme.css" rel="stylesheet" />
    <link href="assets/css/semi-dark.css" rel="stylesheet" />
    <link href="assets/css/header-colors.css" rel="stylesheet" />

    <!-- animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <title>SIM</title>
  <style>
    body {
      background-color: skyblue;
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      background-image: url('assets/img/pemda.png');
      background-position-x: -200px;
      background-repeat: no-repeat;
      background-size: 1980px;
    }

    h1.title {
      text-shadow: 0 0 3px #645858, 0 0 5px #414153;
      color: white;
    }
    .back {
      color: white;
    }
  </style>
</head>

<body>

  <div class="container">

    <div class="row mt-4"></div>

        <div class="row text-center mb-3 mt-4">
          <div class="col">
            <h1 class="title animate__animated animate__fadeInUp animate__delay-1s">
              <a href="index.php" class="lni lni-arrow-left-circle back animate__animated animate__shakeX animate__delay-2s"></a> 
              <span id="title">
                Kecamatan Bayongbong
              </span>
            </h1>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-5 animate__animated animate__fadeInBottomLeft">
            <div class="card radius-10 w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h3 class="mb-0">Izin OSS</h6>
                </div>
                <div class="chart-container3">
                  <div class="piechart-legend">
                    <h2 class="mb-1"><?php echo $total; ?> NIB</h2>
                    <h6 class="mb-0">Total Izin OSS</h6>
                  </div>
                  <canvas id="chart1"></canvas>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                    NIB
                    <span class="badge bg-tiffany rounded-pill"><?php echo $total; ?></span>
                  </li>
                  <br>
                  <br>
                  <br>
                  <br>
                  <div style="font-size:20px;">&nbsp;</div>
                </ul>
                <div class="text-center">
                  <button id="btn-oss" class="btn btn-primary">Selengkapnya...</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5 animate__animated animate__fadeInBottomRight">
            <div class="card radius-10 w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h3 class="mb-0">Izin Non-OSS</h6>
                </div>
                <div class="chart-container3">
                  <div class="piechart-legend">
                    <h2 class="mb-1">530 Izin</h2>
                    <h6 class="mb-0">Total Izin Non-OSS</h6>
                  </div>
                  <canvas id="chart2"></canvas>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                    Trayek
                    <span class="badge bg-tiffany rounded-pill">155</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    SIPP
                    <span class="badge bg-danger rounded-pill">120</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    SIPB
                    <span class="badge bg-success rounded-pill">110</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    SIPA
                    <span class="badge bg-warning rounded-pill">100</span>
                  </li>
                </ul>
                <div class="text-center">
                  <button id="btn-nonoss" class="btn btn-primary">Selengkapnya...</button>
                </div>
              </div>
            </div>
          </div>
        </div><!--end row-->

  </div>

    <!-- JS Files-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--plugins-->
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/chartjs/chart.min.js"></script>
    <script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <!-- <script src="assets/js/index2.js"></script> -->
    <!-- Main JS-->
    <script src="assets/js/main.js"></script>

  <script>
    let searchParams = new URLSearchParams(window.location.search);
    let param = searchParams.get('kec');

    if (param == 1)	{
        $('#title').html("Kecamatan Banjarwangi");
    } else if (param == 2) {
        $('#title').html("Kecamatan Banyuresmi");
    } else if (param == 3) {
        $('#title').html("Kecamatan Bayongbong");
    } else if (param == 4) {
        $('#title').html("Kecamatan Blubur Limbangan");
    } else if (param == 5) {
        $('#title').html("Kecamatan Bungbulang");
    } else if (param == 6) {
        $('#title').html("Kecamatan Caringin");
    } else if (param == 7) {
        $('#title').html("Kecamatan Cibalong");
    } else if (param == 8) {
        $('#title').html("Kecamatan Cibatu");
    } else if (param == 9) {
        $('#title').html("Kecamatan Cibiuk");
    } else if (param == 10) {
        $('#title').html("Kecamatan Cigedug");
    } else if (param == 11) {
        $('#title').html("Kecamatan Cihurip");
    } else if (param == 12) {
        $('#title').html("Kecamatan Cikajang");
    } else if (param == 13) {
        $('#title').html("Kecamatan Cikelet");
    } else if (param == 14) {
        $('#title').html("Kecamatan Cilawu");
    } else if (param == 15) {
        $('#title').html("Kecamatan Cisewu");
    } else if (param == 16) {
        $('#title').html("Kecamatan Cisompet");
    } else if (param == 17) {
        $('#title').html("Kecamatan Cisurupan");
    } else if (param == 18) {
        $('#title').html("Kecamatan Garut Kota");
    } else if (param == 19) {
        $('#title').html("Kecamatan Kadungora");
    } else if (param == 20) {
        $('#title').html("Kecamatan Karangpawitan");
    } else if (param == 21) {
        $('#title').html("Kecamatan Karangtengah");
    } else if (param == 22) {
        $('#title').html("Kecamatan Kersamanah");
    } else if (param == 23) {
        $('#title').html("Kecamatan Leles");
    } else if (param == 24) {
        $('#title').html("Kecamatan Leuwigoong");
    } else if (param == 25) {
        $('#title').html("Kecamatan Malangbong");
    } else if (param == 26) {
        $('#title').html("Kecamatan Mekarmukti");
    } else if (param == 27) {
        $('#title').html("Kecamatan Pakenjeng");
    } else if (param == 28) {
        $('#title').html("Kecamatan Pameungpeuk");
    } else if (param == 29) {
        $('#title').html("Kecamatan Pamulihan");
    } else if (param == 30) {
        $('#title').html("Kecamatan Pangatikan");
    } else if (param == 31) {
        $('#title').html("Kecamatan Pasirwangi");
    } else if (param == 32) {
        $('#title').html("Kecamatan Peundeuy");
    } else if (param == 33) {
        $('#title').html("Kecamatan Samarang");
    } else if (param == 34) {
        $('#title').html("Kecamatan Selaawi");
    } else if (param == 35) {
        $('#title').html("Kecamatan Singajaya");
    } else if (param == 36) {
        $('#title').html("Kecamatan Sucinaraja");
    } else if (param == 37) {
        $('#title').html("Kecamatan Sukaresmi");
    } else if (param == 38) {
        $('#title').html("Kecamatan Sukawening");
    } else if (param == 39) {
        $('#title').html("Kecamatan Talegong");
    } else if (param == 40) {
        $('#title').html("Kecamatan Tarogong Kaler");
    } else if (param == 41) {
        $('#title').html("Kecamatan Tarogong Kidul");
    } else if (param == 42) {
        $('#title').html("Kecamatan Wanaraja");
    } else {}
    
    $('#btn-oss').on('click', function(){
      window.location="https://dpmpt.garutkab.go.id/dashboardinvest/admin/minat_investasilist.php?cmd=search&t=minat_investasi&z_id_kecamatan=%3D&x_id_kecamatan="+param+"&psearch=&psearchtype=";
    });
  </script>

<script>
      $(function() {

        const total = <?php echo $total; ?>;

// chart1
var ctx = document.getElementById('chart1').getContext('2d');

var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, '#005bea');
    gradientStroke1.addColorStop(1, '#00c6fb');

var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, '#ff6a00');  
    gradientStroke2.addColorStop(1, '#ee0979'); 

var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke3.addColorStop(0, '#17ad37');  
    gradientStroke3.addColorStop(1, '#98ec2d'); 

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['NIB'],
        datasets: [{
            data: [total],
            backgroundColor: [
                gradientStroke1,
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        cutout: 110,
        plugins: {
        legend: {
            display: false,
        }
    }
        
    }
});
   
// chart2
var ctx = document.getElementById('chart2').getContext('2d');

var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, '#005bea');
    gradientStroke1.addColorStop(1, '#00c6fb');

var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, '#FC2F8C'); 
    gradientStroke2.addColorStop(1, '#FC2F2F');  

var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke3.addColorStop(0, '#17ad37');  
    gradientStroke3.addColorStop(1, '#98ec2d'); 

var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke4.addColorStop(0, '#FF5733');  
    gradientStroke4.addColorStop(1, '#FFB447'); 

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Trayek', 'SIPP', 'SIPB', 'SIPA'],
        datasets: [{
            data: [155, 120, 110, 100],
            backgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
                gradientStroke4,
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        cutout: 110,
        plugins: {
        legend: {
            display: false,
        }
    }
        
    }
});

});
    </script>

</body>

</html>